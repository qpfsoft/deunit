<?php
namespace qpf\deunit;

/**
 * QPF框架环境调试
 */
class QPFUnit
{
    /**
     * qpf框架目录
     * @var string
     */
    public static $QPF_PATH;
    /**
     * qpfsoft目录
     * @var string
     */
    public static $QPFSOFT_PATH;
    /**
     * composer管理目录
     * @var string
     */
    public static $VENDOR_PATH;
    /**
     * 根目录
     * @var string
     */
    public static $ROOT_PATH;
    /**
     * web服务器入口目录
     * @var string
     */
    public static $WEB_PATH;
    
    /**
     * 初始化
     * @param string $qpf_path
     * @return void
     */
    public static function init($qpf_path = __DIR__)
    {
        self::$QPF_PATH = $qpf_path;
        
        if (substr(self::$QPF_PATH, -3) == 'src') {
            self::$QPFSOFT_PATH = dirname(dirname(self::$QPF_PATH));
        } else {
            self::$QPFSOFT_PATH = dirname(self::$QPF_PATH);
        }
        
        self::$VENDOR_PATH = dirname(self::$QPFSOFT_PATH);
        self::$ROOT_PATH = dirname(self::$VENDOR_PATH);
        self::$WEB_PATH = self::$ROOT_PATH . DIRECTORY_SEPARATOR . 'web';
    }
}