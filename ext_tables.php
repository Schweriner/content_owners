<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {
        $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_userauthgroup.php']['recordEditAccessInternals'][]
            = \JanSass\ContentOwners\Hooks\OwnerCheck::class . '->check';

        $hideUnAssigned = (bool) \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
            \TYPO3\CMS\Core\Configuration\ExtensionConfiguration::class
        )->get('content_owners', 'hideUnassignedRows');

        if (true === $hideUnAssigned) {
            $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['typo3/class.db_list_extra.inc']['getTable'][] =
                \JanSass\ContentOwners\Hooks\RecordListTableHook::class;
        }
    }
);
