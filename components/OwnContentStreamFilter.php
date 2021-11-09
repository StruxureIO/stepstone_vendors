<?php


namespace humhub\modules\stepstone_vendors\components;

use humhub\modules\stream\models\filters\StreamQueryFilter;

class OwnContentStreamFilter extends StreamQueryFilter
{
    const FILTER_ID = 'filter_my_content';

    public $filters = [];

    public function rules()
    {
        return [
            ['filters', 'safe']
        ];
    }

    public function apply()
    {
        $parts = parse_url($_SERVER['HTTP_REFERER']);
        parse_str($parts['query'], $query);
        $vendorId = intval($query['id']);
        $this->streamQuery
            ->query()
            ->innerJoin('vendor_comments', 'content.object_id = vendor_comments.id and content.object_model like \'%VendorComments%\'')
            ->andWhere(['vendor_comments.vendor_id' => $vendorId]);
    }
}
