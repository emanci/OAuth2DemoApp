<?php
/**
 * Created by PhpStorm.
 * Author: phil <zhengchaopu@gmail.com>
 * Date: 2016/11/14.
 */

namespace app\Support;

use Monolog\Handler\NullHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Monolog\Handler\StreamHandler;

/**
 * Class Log.
 *
 * @method emergency(string $message, array $context, $filename); // 紧急状况，比如系统挂掉
 * @method alert(string $message, array $context, $filename);     // 需要立即采取行动的问题，比如整站宕掉，数据库异常等，这种状况应该通过短信提醒
 * @method critical(string $message, array $context, $filename);  // 严重问题，比如：应用组件无效，意料之外的异常
 * @method error(string $message, array $context, $filename);     // 运行时错误，不需要立即处理但需要被记录和监控
 * @method warning(string $message, array $context, $filename);   // 警告但不是错误，比如使用了被废弃的API
 * @method notice(string $message, array $context, $filename);    // 普通但值得注意的事件
 * @method info(string $message, array $context, $filename);      // 感兴趣的事件，比如登录、退出
 * @method debug(string $message, array $context, $filename);     // 详细的调试信息
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
     * Logger levels.
     *
     * @var array
     */
    protected static $levels = [
        'debug' => Logger::DEBUG,
        'info' => Logger::INFO,
        'notice' => Logger::NOTICE,
        'warning' => Logger::WARNING,
        'error' => Logger::ERROR,
        'critical' => Logger::CRITICAL,
        'alert' => Logger::ALERT,
        'emergency' => Logger::EMERGENCY,
    ];

    /**
     * Return the logger instance.
     *
     * @param string $level
     *
     * @return \Psr\Log\LoggerInterface
     */
    public static function getLogger($level)
    {
        if (!isset(self::$loggers[$level])) {
            self::$loggers[$level] = self::createLogger($level);
        }

        return self::$loggers[$level];
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
     * Forward call.
     *
     * @param string $method
     * @param array  $args
     *
     * @return mixed
     */
    public static function __callStatic($method, $args)
    {
        return forward_static_call_array([self::getLogger($method), $method], $args);
    }

    /**
     * Forward call.
     *
     * @param string $method
     * @param array  $args
     *
     * @return mixed
     */
    public function __call($method, $args)
    {
        return call_user_func_array([self::logger($method), $method], $args);
    }

    /**
     * Make a log instance.
     *
     * @param string $level
     *
     * @return Logger
     */
    protected static function createLogger($level)
    {
        $log = new Logger('OAuth2DemoAppLog');
        if (config('debug')) {
            $log->pushHandler(new NullHandler());
        } else {
            $log->pushProcessor(new UidProcessor());
            $log->pushHandler(new StreamHandler(self::getLogFile(), self::$levels[$level]));
        }

        return $log;
    }

    /**
     * Get log file name.
     *
     * @return \config|mixed|string|void
     */
    protected static function getLogFile()
    {
        if ($logFile = config('log.file')) {
            return $logFile;
        }

        return APP_PATH.'/storage/logs/'.date('Y-m-d', time()).'.log';
    }
}
