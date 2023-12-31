<?php


namespace App\Traits;


use Exception;
use LaravelCommon\App\Exceptions\Err;

trait ControllerTrait
{
    /**
     * @intro 获得分页
     * @return int
     */
    protected function getPage(): int
    {
        $params = request()->only('page');
        error_log('Get Page' . json_encode($params));
        if (!isset($params['page']) || !is_numeric($params['page']))
            return 1;

        return (int)$params['page'];
    }

    /**
     * @intro 获得分页size
     * @return int
     * @throws Err
     */
    protected function perPage(): int
    {
        $params = request()->only('perPage');
        error_log('Per Page' . json_encode($params));
        if (!isset($params['perPage']) || !is_numeric($params['perPage']))
            return 20;

        $allow = config('common.perPageAllow', [10, 20, 50, 100, 1000, 10000]);
        if (!in_array($params['perPage'], $allow))
            throw new Exception('[perPage] is not in the range');

        return (int)$params['perPage'];
    }

    /**
     * @intro 获得mines
     * @return string
     */
    protected function getMines(): string
    {
        $mime_image = 'gif,jpeg,png,ico,svg';
        $mine_docs = 'xls,xlsx,doc,docx,ppt,pptx,pdf';
        $mine_zip = '7z,zip,rar';
        return $mime_image . ',' . $mine_docs . ',' . $mine_zip;
    }

    /**
     * @param array $params
     * @param string $key
     */
    protected function crypto(array &$params, string $key = 'password'): void
    {
        if (isset($params[$key]))
            $params[$key] = bcrypt($params[$key]);
    }

    /**
     * @param array $params
     * @param string $key
     * @return void
     */
    protected function yesOrNo(array &$params, string $key): void
    {
        if (isset($params[$key])) {
            $params[$key] = $params[$key] == 'Yes';
        }
    }
}
