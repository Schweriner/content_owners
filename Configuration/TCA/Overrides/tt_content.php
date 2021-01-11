<?php
defined('TYPO3_MODE') or die();

$ttContentEnabled = (bool) \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Configuration\ExtensionConfiguration::class)->get('content_owners', 'autoEnableForTtcontent');

if(true === $ttContentEnabled) {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content',
        \JanSass\ContentOwners\Utility\TcaUtility::getRestrictionTcaField()
    );
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('tt_content', 'tx_contentowner_owner', '', 'after:endtime');
}
