<?php
/**
 * Created by PhpStorm.
 * Author: phil <zhengchaopu@gmail.com>
 * Date: 2016/11/14.
 */
namespace Wap\Utils;

use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Monolog\Handler\StreamHandler;

/**
 * Class Log
 * Log::emergency($error); // 紧急状况，比如系统挂掉
 * Log::alert($error);     // 需要立即采取行动的问题，比如整站宕掉，数据库异常等，这种状况应该通过短信提醒
 * Log::critical($error);  // 严重问题，比如：应用组件无效，意料之外的异常
 * Log::error($error);     // 运行时错误，不需要立即处理但需要被记录和监控
 * Log::warning($error);   // 警告但不是错误，比如使用了被废弃的API
 * Log::notice($error);    // 普通但值得注意的事件
 * Log::info($error);      // 感兴趣的事件，比如登录、退出
 * Log::debug($error);     // 详细的调试信息
 */
class Log
{
    /**
     * Logger instance.
     *
     * @var
     */
    protected static $loggers = [];

    /**
     * Logger file.
     *
     * @var
     */
    protected static $logFile;

    /**
     * Logger level.
     *
     * @var
     */
    protected static $logLevel;

    /**
     * Logger file suffix.
     *
     * @var string
     */
    protected static $logSuffix = 'log';

    /**
     * Logger levels.
     *
     * @var array
     */
    protected static $levels = [
        'debug' => 100,
        'info' => 200,
        'notice' => 250,
        'warning' => 300,
        'error' => 400,
        'critical' => 500,
        'alert' => 550,
        'emergency' => 600,
    ];

    /**
     * Return the logger instance.
     *
     * @return mixed
     */
    public static function logger($logger)
    {
        if (!isset(self::$loggers[$logger])) {
            self::$loggers[$logger] = self::createLogger($logger);
        }

        return self::$loggers[$logger];
    }

    /**
     * Set logger.
     *
     * @param LoggerInterface $logger
     */
    public static function setLogger(LoggerInterface $logger)
    {
        self::$logger = $logger;
    }

    /**
     * Set Logger file suffix.
     *
     * @param $logSuffix
     */
    public function setLogSuffix($logSuffix)
    {
        self::$logSuffix = $logSuffix;
    }

    /**
     * Forward call.
     *
     * @param $method
     * @param $args
     *
     * @return mixed
     */
    public static function __callStatic($method, $args)
    {
        self::setLoggerConfiguration($method, $args);

        //echo self::getLogger();die();
        return forward_static_call_array([self::logger($method), $method], $args);
    }

    /**
     * Forward call.
     *
     * @param $method
     * @param $args
     *
     * @return mixed
     */
    public function __call($method, $args)
    {
        self::setLoggerConfiguration($method, $args);

        return call_user_func_array([self::logger($method), $method], $args);
    }

    /**
     * Set logger configuration.
     *
     * @param $method
     * @param $args
     */
    protected static function setLoggerConfiguration($method, $args)
    {
        self::$logLevel = $method;
        self::$logFile = isset($args[2]) ? $args[2] : 'xiaofei';
    }

    /**
     * Make a log instance.
     *
     * @return Logger
     */
    protected static function createLogger($logger)
    {
        $log = new Logger('XiaofeiLog');
        $logFile = APP_PATH.'/log/'.self::$logFile.'.'.self::$logSuffix;

        $log->pushProcessor(new UidProcessor());
        /*echo self::$levels[self::$logLevel];
        die();*/
        $log->pushHandler(new StreamHandler($logFile, self::$levels[$logger]));

        return $log;
    }
}
