Приложение для учета расходов
============================

Веб-приложение для учета личных расходов разработано на фреймворке [Yii 2](http://www.yiiframework.com/) в качестве тестового задания

Приложение позволяет:
1. Заносить новые расходы
2. Просматривать сводный отчет по расходам
3. Просматривать детализированный отчет
4. Создавать и редактировать список категорий расходов
5. Задавать предельную сумму месячных расходов, а также выбирать
сценарий поведения при превышении данной суммы

Структура проекта
-------------------

      assets/             contains assets definition
      commands/           contains console commands (controllers)
      config/             contains application configurations
      controllers/        contains Web controller classes
      mail/               contains view files for e-mails
      models/             contains model classes
      runtime/            contains files generated during runtime
      source/             Содержит основной код приложения
        entities/         Содержит все модели ActiveRecord
        forms/            Содержит все модели форм
        helpers/          Различные вспомогательные классы
        repositories/     Содержит все репозитории для работы с сущностями
        services/         Содержит все сервисы, реализующие бизнес-логику приложения
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources



REQUIREMENTS
------------

Приложение разработано на языке php версии 7.1, база данных SQLite
