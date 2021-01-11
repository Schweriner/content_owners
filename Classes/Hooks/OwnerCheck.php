<?php
namespace JanSass\ContentOwners\Hooks;


class OwnerCheck
{

    /**
     * @param array $record
     * @param \TYPO3\CMS\Core\Authentication\AbstractUserAuthentication $pObj
     * @return bool
     */
    public function check($record, $pObj) {

        // \sysext\recordlist\Classes\RecordList\DatabaseRecordList.php

        if($record['newRecord'] === true || TYPO3_MODE !== 'BE') {
            return true;
        }

        if(false === is_array($record['idOrRow']) || true === empty($record['idOrRow']['tx_contentowner_owner'])) {
            return true;
        }

        if($record['idOrRow']['tx_contentowner_owner'] !== $GLOBALS['BE_USER']->user['uid']) {
            return false;
        }

        return true;
    }

}
