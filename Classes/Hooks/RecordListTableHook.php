<?php

namespace JanSass\ContentOwners\Hooks;

class RecordListTableHook implements \TYPO3\CMS\Backend\RecordList\RecordListGetTableHookInterface
{
    /**
     * modifies the DB list query
     *
     * @param string $table The current database table
     * @param int $pageId The record's page ID
     * @param string $additionalWhereClause An additional WHERE clause
     * @param string $selectedFieldsList Comma separated list of selected fields
     * @param \TYPO3\CMS\Recordlist\RecordList\DatabaseRecordList $parentObject Parent \TYPO3\CMS\Recordlist\RecordList\DatabaseRecordList object
     */
    public function getDBlistQuery($table, $pageId, &$additionalWhereClause, &$selectedFieldsList, &$parentObject)
    {
        if (false === isset($GLOBALS['TCA'][$table]['columns']['tx_contentowner_owner'])) return;
        if (TYPO3_MODE !== 'BE' || false === isset($GLOBALS['BE_USER']->user['admin'])) return;
        if (true === (bool) $GLOBALS['BE_USER']->user['admin']) return;

        if(true === empty(trim($additionalWhereClause))) {
            $additionalWhereClause .= '('. $table . '.tx_contentowner_owner=0 OR '
                . $table . '.tx_contentowner_owner=' . $GLOBALS['BE_USER']->user['uid'] . ')';
        } else {
            $additionalWhereClause .= ') AND (('. $table . '.tx_contentowner_owner=0 OR '
                . $table . '.tx_contentowner_owner=' . $GLOBALS['BE_USER']->user['uid'] . ')';
        }
    }

}
