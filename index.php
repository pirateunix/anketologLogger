<?php
/**
 * Задача: реализовать необходимы классы и методы для запуска данного файла
 *
 * Основные требования:
 * - модифицировать файл нельзя
 * - использование composer (@see https://getcomposer.org)
 * - использование реализации стандарта PSR-3 (@see https://packagist.org/packages/psr/log)
 * - аккуратность, чистота кода
 * - документация (для каждого метода, поля, класса есть DocBlock)
 * - комментарии в коде для непонятных участков
 *
 * Результатом выполнение программы должны быть 3 файла:
 *
 * application.log
 * *****************
 * 2016-05-30T09:50:57+00:00  ERRORLVL  Error message
 * 2016-05-30T09:50:57+00:00  ERRORLVL  Error message
 * 2016-05-30T09:50:57+00:00  INFOLVL  Info message
 * 2016-05-30T09:50:57+00:00  INFOLVL  Info message
 * *****************
 *
 * application.error.log
 * *****************
 * 2016-05-30T09:50:57+00:00  ERRORLVL  Error message
 * 2016-05-30T09:50:57+00:00  ERRORLVL  Error message
 * *****************
 *
 * application.info.log
 * *****************
 * 2016-05-30T09:50:57+00:00  INFOLVL  Info message
 * 2016-05-30T09:50:57+00:00  INFOLVL  Info message
 * *****************
 */
require_once(__DIR__ . '/vendor/autoload.php');
/**
 * Наш компонент для логирования
 */
$logger = new OurLogger\Component();
/**
 * Обработчик который все логи будет писать в файл application.log
 */
$logger->addLogger(new OurLogger\FileLogger([
    'filename' => __DIR__ . '/application.log',
]));
/**
 * Обработчик который все ошибки будет писать в файл application.error.log
 */
$logger->addLogger(new OurLogger\FileLogger([
    'filename'  => __DIR__ . '/application.error.log',
    'levels'    => [
        Psr\Log\LogLevel::ERROR,
    ],
]));
/**
 * Обработчик который все информационные логи будет писать в файл application.info.log
 */
$logger->addLogger(new OurLogger\FileLogger([
    'filename'  => __DIR__ . '/application.info.log',
    'levels'    => [
        Psr\Log\LogLevel::INFO,
    ],
]));
/**
 * Обработчик который все debug логи записывает в syslog
 *
 * @see http://php.net/manual/ru/function.syslog.php
 */
$logger->addLogger(new OurLogger\SyslogLogger([
    'levels'    => [
        Psr\Log\LogLevel::DEBUG,
    ],
]));
/**
 * Обработчик который ничего не делает
 */
$logger->addLogger(new OurLogger\NullLogger([
]));
$logger->log(Psr\Log\LogLevel::ERROR, 'Error message');
$logger->error('Error message');
$logger->log(Psr\Log\LogLevel::INFO, 'Info message');
$logger->info('Info message');