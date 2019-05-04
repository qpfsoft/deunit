<?php
namespace qpf\deunit;

/**
 * 结果类
 */
class Results
{
    /**
     * 解析单元测试结果
     * @param mixed $result
     * @return TrueResult|FalseResult|ShowResult
     */
    public static function parse($result)
    {
        if ($result === true) {
            return new TrueResult();
        } elseif ($result === false) {
            return new FalseResult();
        } else {
            return new ShowResult($result);
        }
    }
    
    /**
     * 结果评估统计
     * @param array $results 单元测试结果集合
     * @return array 返回统计数组, 格式如下:
     * ['__ok__' => count, '__error__' => count]
     */
    public static function assess($results)
    {
        $assess = [];
        foreach ($results as $i => $result) {
            $assess[] = (string) $result;
        }
        
       return array_count_values($assess);
    }
    
    /**
     * 结果评估详细信息
     * @param array $results 单元测试结果集合
     * @param array $assess 可选, 结果评估统计[[assess()]]返回值
     * @return array
     */
    public static function assessInfo($results, $assess = null)
    {
        $info['count'] = count($results);
        $assess = $assess ?: self::assess($results);
        $info['pass'] = round($assess['__ok__'] / $info['count'] * 100) . '%';
        $info['fail'] = round($assess['__error__'] / $info['count'] * 100) . '%';
        $info['info'] = [];
        
        foreach ($results as $method => $result) {
            if ($result instanceof ResultInterface) {
                $info['info'][$method] = $result->result;
            } else {
                $info['info'][$method] = $result;
            }
        }
        
        return $info;
    }
}