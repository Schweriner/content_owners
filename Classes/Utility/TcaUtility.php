<?php
namespace JanSass\ContentOwners\Utility;


class TcaUtility
{

    public static function getRestrictionTcaField() {

        $returnTca = [
            'tx_contentowner_owner' => [
                'exclude' => true,
                'label' => 'LLL:EXT:content_owners/Resources/Private/Language/locallang_db.xlf:tt_content.fieldname',
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectSingle',
                    'itemsProcFunc' => TcaUtility::class . '->filterUsers',
                    'items' => [
                        ['', 0]
                    ],
                    'default' => 0,
                    'foreign_table' => 'be_users',
                    'foreign_table_where' => 'admin=0'
                ]
            ]
        ];

        return $returnTca;

    }

    public function filterUsers($config) {

        if(true === $GLOBALS['BE_USER']->isAdmin()) {
            return;
        }

        /** @var \TYPO3\CMS\Core\Configuration\ExtensionConfiguration $extensionConfiguration */
        $extensionConfiguration = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Configuration\ExtensionConfiguration::class)->get('content_owners');

        if(true === (bool) $extensionConfiguration['selfAssignRestriction']) {
            foreach ($config['items'] as $selectItem) {
                if($selectItem[1] === $GLOBALS['BE_USER']->user['uid']) {
                    // Not for non-new items
                    if(true === (bool) $extensionConfiguration['autoAssignToNonAdmins'] && false !== strpos($config['row']['uid'], 'NEW')) {
                        $config['items'] = [
                            $selectItem
                        ];
                    } else {
                        $config['items'] = [
                            0 => ['',0],
                            1 => $selectItem
                        ];
                    }
                    break;
                }
            }
        }
    }

}
