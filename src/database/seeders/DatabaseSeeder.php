<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Customer;
use App\Models\Department;
use App\Models\Discounts;
use App\Models\MaterialCategory;
use App\Models\MaterialStok;
use App\Models\ProductStok;
use App\Models\Salary_Type;
use App\Models\Type;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $user = User::factory()->create([
            'name' => 'Админ',
            'phone' => '+998941050405',
        ]);

        $user1 = User::factory()->create([
            'name' => 'Отдел кадров',
            'phone' => '+998941050406',
        ]);

        $user2 = User::factory()->create([
            'name' => 'Бугалтер',
            'phone' => '+998941050412',
        ]);

        $user3 = User::factory()->create([
            'name' => 'Отдел продаж',
            'phone' => '+998941050407',
        ]);

        $user4 = User::factory()->create([
            'name' => 'Производитель',
            'phone' => '+998941004444',
        ]);

        $user5 = User::factory()->create([
            'name' => 'Менеджер склада',
            'phone' => '+998941050409',
        ]);

        $user6 = User::factory()->create([
            'name' => 'Машинист',
            'phone' => '+998941050410',
        ]);

        $user7 = User::factory()->create([
            'name' => 'Курьер',
            'phone' => '+998941050411',
        ]);

        $user8 = User::factory()->create([
            'name' => 'Механик',
            'phone' => '+998941004445',
        ]);

        $user9 = User::factory()->create([
            'name' => 'Склад продукции',
            'phone' => '+998941004446',
        ]);


        $role = Role::create(['name' => 'Супер администратор']);
        $role1 = Role::create(['name' => 'Отдел кадров']);
        $role2 = Role::create(['name' => 'Бугалтер']);
        $role3 = Role::create(['name' => 'Отдел продаж']);
        $role4 = Role::create(['name' => 'Производитель']);         // ishlab chiqaruvchi
        $role5 = Role::create(['name' => 'Менеджер склада']);
        $role6 = Role::create(['name' => 'Склад продукции']);
        $role7 = Role::create(['name' => 'Машинист']);
        $role8 = Role::create(['name' => 'Курьер']);

        // Zakazni qabul qiladi. qilish stanokchi
        $role8 = Role::create(['name' => 'Механик']);

        // Производитель ishlab chiqaruvchi

        // Пользователь
        Permission::create([
            'name' => 'user.list',
            'name_menyu' => 'Админ, Пользователи'
        ]);
        Permission::create([
            'name' => 'user.show',
            'name_menyu' => 'Админ, Пользовател видеть'
        ]);
        Permission::create([
            'name' => 'user.create',
            'name_menyu' => 'Админ, Добавить пользователя'
        ]);
        Permission::create([
            'name' => 'user.update',
            'name_menyu' => 'Админ, Обновить пользователя'
        ]);
        Permission::create([
            'name' => 'user.delete',
            'name_menyu' => 'Админ, Удалить пользователя'
        ]);

        // Клиент
        Permission::create([
            'name' => 'customer.list',
            'name_menyu' => 'Отдел продаж, Клиенты'
        ]);
        Permission::create([
            'name' => 'customer.show',
            'name_menyu' => 'Отдел продаж, Клиент видеть'
        ]);
        Permission::create([
            'name' => 'customer.create',
            'name_menyu' => 'Отдел продаж, Добавить клиенты'
        ]);
        Permission::create([
            'name' => 'customer.update',
            'name_menyu' => 'Отдел продаж, Обновить клиент'
        ]);
        Permission::create([
            'name' => 'customer.delete',
            'name_menyu' => 'Отдел продаж, Удалить клиент'
        ]);

        // Фирмы
        Permission::create([
            'name' => 'firm.list',
            'name_menyu' => 'Отдел продаж, Фирмы'
        ]);
        Permission::create([
            'name' => 'firm.show',
            'name_menyu' => 'Отдел продаж, Клиент видеть'
        ]);
        Permission::create([
            'name' => 'firm.create',
            'name_menyu' => 'Отдел продаж, Добавить фирма'
        ]);
        Permission::create([
            'name' => 'firm.update',
            'name_menyu' => 'Отдел продаж, Обновить фирма'
        ]);

        Permission::create([
            'name' => 'firm.delete',
            'name_menyu' => 'Отдел продаж, Удалить фирма'
        ]);

        // Отделение
        Permission::create([
            'name' => 'department.list',
            'name_menyu' => 'Отдел кадров, Отделение'
        ]);
        Permission::create([
            'name' => 'department.show',
            'name_menyu' => 'Отдел кадров, Отделение видеть'
        ]);
        Permission::create([
            'name' => 'department.create',
            'name_menyu' => 'Отдел кадров, Добавить Отделение'
        ]);
        Permission::create([
            'name' => 'department.update',
            'name_menyu' => 'Отдел кадров, Обновить Отделение'
        ]);

        Permission::create([
            'name' => 'department.delete',
            'name_menyu' => 'Отдел кадров, Удалить Отделение'
        ]);

        // Тип зарплаты
        Permission::create([
            'name' => 'salarytype.list',
            'name_menyu' => 'Отдел кадров, Тип зарплаты'
        ]);
        Permission::create([
            'name' => 'salarytype.show',
            'name_menyu' => 'Отдел кадров, Тип зарплаты видеть'
        ]);
        Permission::create([
            'name' => 'salarytype.create',
            'name_menyu' => 'Отдел кадров, Добавить Тип зарплаты'
        ]);
        Permission::create([
            'name' => 'salarytype.update',
            'name_menyu' => 'Отдел кадров, Обновить Тип зарплаты'
        ]);

        Permission::create([
            'name' => 'salarytype.delete',
            'name_menyu' => 'Отдел кадров, Удалить Тип зарплаты'
        ]);

        // Сотрудники
        Permission::create([
            'name' => 'staf.list',
            'name_menyu' => 'Отдел кадров, Сотрудники'
        ]);
        Permission::create([
            'name' => 'staf.show',
            'name_menyu' => 'Отдел кадров, Сотрудники видеть'
        ]);
        Permission::create([
            'name' => 'staf.view',
            'name_menyu' => 'Отдел кадров, Сотрудники Функция'
        ]);
        Permission::create([
            'name' => 'staf.create',
            'name_menyu' => 'Отдел кадров, Добавить Сотрудники'
        ]);
        Permission::create([
            'name' => 'staf.update',
            'name_menyu' => 'Отдел кадров, Обновить Сотрудники'
        ]);

        Permission::create([
            'name' => 'staf.delete',
            'name_menyu' => 'Отдел кадров, Удалить Сотрудники'
        ]);

        // Курьер
        Permission::create([
            'name' => 'courier.list',
            'name_menyu' => 'Отдел кадров, Курьер'
        ]);
        Permission::create([
            'name' => 'courier.show',
            'name_menyu' => 'Отдел кадров, Курьер видеть'
        ]);
        Permission::create([
            'name' => 'courier.create',
            'name_menyu' => 'Отдел кадров, Добавить Курьер'
        ]);
        Permission::create([
            'name' => 'courier.update',
            'name_menyu' => 'Отдел кадров, Обновить Курьер'
        ]);

        Permission::create([
            'name' => 'courier.delete',
            'name_menyu' => 'Отдел кадров, Удалить Курьер'
        ]);

        // Ishlab chiqaruvchi

        // Станок
        $p5 = Permission::create([
            'name' => 'equipment.list',
            'name_menyu' => 'Производитель, Станок'
        ]);
        $p6 = Permission::create([
            'name' => 'equipment.show',
            'name_menyu' => 'Производитель, Станок видеть'
        ]);
        $p7 = Permission::create([
            'name' => 'equipment.create',
            'name_menyu' => 'Производитель, Добавить Станок'
        ]);
        $p8 = Permission::create([
            'name' => 'equipment.update',
            'name_menyu' => 'Производитель, Обновить Станок'
        ]);

        $p9 = Permission::create([
            'name' => 'equipment.delete',
            'name_menyu' => 'Производитель, Удалить Станок'
        ]);

        // Ishlab chiqaruvchi

        // Зарплата
        Permission::create([
            'name' => 'salary.list',
            'name_menyu' => 'Бугалтер, Зарплата'
        ]);
        Permission::create([
            'name' => 'salary.show',
            'name_menyu' => 'Бугалтер, Зарплата видеть'
        ]);
        Permission::create([
            'name' => 'salary.create',
            'name_menyu' => 'Бугалтер, Добавить Зарплата'
        ]);
        Permission::create([
            'name' => 'salary.update',
            'name_menyu' => 'Бугалтер, Обновить Зарплата'
        ]);

        Permission::create([
            'name' => 'salary.delete',
            'name_menyu' => 'Бугалтер, Удалить Зарплата'
        ]);

        Permission::create([
            'name' => 'salary.search',
            'name_menyu' => 'Бугалтер, Поиск Зарплата'
        ]);

        // Штрафы
        Permission::create([
            'name' => 'fines.create',
            'name_menyu' => 'Бугалтер, Добавить Штрафы'
        ]);


        // Накладной
        Permission::create([
            'name' => 'nakladnoy.list',
            'name_menyu' => 'Менеджер склада, Накладной'
        ]);
        Permission::create([
            'name' => 'nakladnoy.view',
            'name_menyu' => 'Менеджер склада, Накладной видеть'
        ]);
        Permission::create([
            'name' => 'nakladnoy.create',
            'name_menyu' => 'Менеджер склада, Добавить Накладной'
        ]);
        Permission::create([
            'name' => 'nakladnoy.update',
            'name_menyu' => 'Менеджер склада, Обновить Накладной'
        ]);

        Permission::create([
            'name' => 'nakladnoy.delete',
            'name_menyu' => 'Менеджер склада, Удалить Накладной'
        ]);


        // Сырье поделиться
        Permission::create([
            'name' => 'material.share',
            'name_menyu' => 'Менеджер склада, Сырье поделиться'
        ]);

        // Приход
        Permission::create([
            'name' => 'prixod.create',
            'name_menyu' => 'Менеджер склада, Добавить Приход'
        ]);
        Permission::create([
            'name' => 'prixod.update',
            'name_menyu' => 'Менеджер склада, Обновить Приход'
        ]);

        Permission::create([
            'name' => 'prixod.delete',
            'name_menyu' => 'Менеджер склада, Удалить Приход'
        ]);

        // Приход
        Permission::create([
            'name' => 'material.list',
            'name_menyu' => 'Менеджер склада, Материал'
        ]);
        Permission::create([
            'name' => 'material.create',
            'name_menyu' => 'Менеджер склада, Добавить Материал'
        ]);
        Permission::create([
            'name' => 'material.update',
            'name_menyu' => 'Менеджер склада, Обновить Материал'
        ]);

        Permission::create([
            'name' => 'material.delete',
            'name_menyu' => 'Менеджер склада, Удалить Материал'
        ]);

        // Материалов на склад
        Permission::create([
            'name' => 'material_stoks.list',
            'name_menyu' => 'Менеджер склада, Материалов на склад'
        ]);
        Permission::create([
            'name' => 'material_stoks.create',
            'name_menyu' => 'Менеджер склада, Добавить Материалов на склад'
        ]);
        Permission::create([
            'name' => 'material_stoks.show',
            'name_menyu' => 'Менеджер склада, Склад сырья список'
        ]);
        Permission::create([
            'name' => 'material_stoks.update',
            'name_menyu' => 'Менеджер склада, Обновить Материалов на склад'
        ]);

        Permission::create([
            'name' => 'material_stoks.delete',
            'name_menyu' => 'Менеджер склада, Удалить Материалов на склад'
        ]);

        Permission::create([
            'name' => 'material_stoks.status',
            'name_menyu' => 'Менеджер склада, Cклад статус'
        ]);

        // material_stok.search
        Permission::create([
            'name' => 'material_stok.search',
            'name_menyu' => 'Менеджер склада, Поиск материалов на складе'
        ]);


        // Склад продукции
        Permission::create([
            'name' => 'product_stoks.list',
            'name_menyu' => 'Склад продукции, Склад продукции'
        ]);

        Permission::create([
            'name' => 'product_stoks.create',
            'name_menyu' => 'Склад продукции, Добавить Склад продукции'
        ]);

        Permission::create([
            'name' => 'product_stoks.update',
            'name_menyu' => 'Склад продукции, Обновить Склад продукции'
        ]);

        Permission::create([
            'name' => 'product_stoks.delete',
            'name_menyu' => 'Склад продукции, Удалить Склад продукции'
        ]);

        Permission::create([
            'name' => 'product_stoks.status',
            'name_menyu' => 'Склад продукции, Склад продукции статус'
        ]);

        // Ishlab chiqaruvchi

        // Модель продукта
        $p10 = Permission::create([
            'name' => 'product_model.list',
            'name_menyu' => 'Производитель, Модель продукта'
        ]);

        $p11 = Permission::create([
            'name' => 'product_model.create',
            'name_menyu' => 'Производитель, Добавить Модель продукта'
        ]);

        $p12 = Permission::create([
            'name' => 'product_model.update',
            'name_menyu' => 'Производитель, Обновить Модель продукта'
        ]);

        $p13 = Permission::create([
            'name' => 'product_model.delete',
            'name_menyu' => 'Производитель, Удалить Модель продукта'
        ]);


        // Модель продукта, изображение
        $p14 = Permission::create([
            'name' => 'product_model_img.delete',
            'name_menyu' => 'Производитель, Удалить изображение'
        ]);

        $p15 = Permission::create([
            'name' => 'product_model_input.delete',
            'name_menyu' => 'Производитель, Удалить продукта поле'
        ]);

        // Ishlab chiqaruvchi

        // Производство продукции
        $p16 = Permission::create([
            'name' => 'product_production.list',
            'name_menyu' => 'Производитель, Модель продукта'
        ]);

        $p17 = Permission::create([
            'name' => 'product_production.create',
            'name_menyu' => 'Производитель, Добавить Модель продукта'
        ]);

        $p18 = Permission::create([
            'name' => 'product_production.update',
            'name_menyu' => 'Производитель, Обновить Модель продукта'
        ]);

        $p19 = Permission::create([
            'name' => 'product_production.delete',
            'name_menyu' => 'Производитель, Удалить Модель продукта'
        ]);
        // Ishlab chiqaruvchi


        // zakazqabul qilivchi mexanik

        // заказ на производство продукции
        $z1 = Permission::create([
            'name' => 'product_production_order.list',
            'name_menyu' => 'Механик, Заказ продукта'
        ]);

        // statusUpdate
        $z2 = Permission::create([
            'name' => 'statusUpdate',
            'name_menyu' => 'Механик, Обновить Заказ статус'
        ]);
        // finished
        $z3 = Permission::create([
            'name' => 'finished',
            'name_menyu' => 'Механик, Заказ законченный'
        ]);
        // zakazqabul qilivchi mexanik

        // Структура модели
        Permission::create([
            'name' => 'model_structure.list',
            'name_menyu' => 'Структура модели'
        ]);

        Permission::create([
            'name' => 'model_structure.create',
            'name_menyu' => 'Добавить Структура модели'
        ]);

        Permission::create([
            'name' => 'model_structure.update',
            'name_menyu' => 'Обновить Структура модели'
        ]);

        Permission::create([
            'name' => 'model_structure.delete',
            'name_menyu' => 'Удалить Структура модели'
        ]);

        // Стоимость продукта на складе
        Permission::create([
            'name' => 'product_stok_value.list',
            'name_menyu' => 'Склад продукции, Стоимость продукта'
        ]);

        Permission::create([
            'name' => 'product_stok_value.create',
            'name_menyu' => 'Склад продукции, Добавить Стоимость продукта'
        ]);

        Permission::create([
            'name' => 'product_stok_value.update',
            'name_menyu' => 'Склад продукции, Обновить Стоимость продукта'
        ]);

        Permission::create([
            'name' => 'product_stok_value.delete',
            'name_menyu' => 'Склад продукции, Удалить Стоимость продукта'
        ]);


        // Поиск товаров на складе
        Permission::create([
            'name' => 'product_stok_value.search',
            'name_menyu' => 'Склад продукции, Поиск товаров на складе'
        ]);

        Permission::create([
            'name' => 'product.share',
            'name_menyu' => 'Склад продукции, Поделиться продуктом'
        ]);

        // Заявки
        Permission::create([
            'name' => 'applications.list',
            'name_menyu' => 'Отдел продаж'
        ]);
        Permission::create([
            'name' => 'applications.show',
            'name_menyu' => 'Отдел продаж, Посмотреть заявку подробно'
        ]);

        Permission::create([
            'name' => 'application.show',
            'name_menyu' => 'Отдел продаж, Заявки Показ'
        ]);

        Permission::create([
            'name' => 'OneModel.show',
            'name_menyu' => 'Отдел продаж, Одна модель Показ'
        ]);

        Permission::create([
            'name' => 'price.show',
            'name_menyu' => 'Отдел продаж, Цена Показ'
        ]);

        Permission::create([
            'name' => 'application.view',
            'name_menyu' => 'Отдел продаж, Заявки Показ'
        ]);

        Permission::create([
            'name' => 'applications.create',
            'name_menyu' => 'Отдел продаж, Добавить Заявки'
        ]);

        Permission::create([
            'name' => 'applications.update',
            'name_menyu' => 'Отдел продаж, Обновить Заявкиа'
        ]);

        Permission::create([
            'name' => 'applications.delete',
            'name_menyu' => 'Отдел продаж, Удалить Заявки'
        ]);

        Permission::create([
            'name' => 'add.curier',
            'name_menyu' => 'Отдел продаж, Вид поставки'
        ]);

        Permission::create([
            'name' => 'delete_application_model_product.delete',
            'name_menyu' => 'Отдел продаж, Удалить товар в Заявки'
        ]);

        Permission::create([
            'name' => 'nakladnoy.store',
            'name_menyu' => 'Менеджер склада, Добавить накладной'
        ]);

        Permission::create([
            'name' => 'delivery.bot',
            'name_menyu' => 'Производитель, Отправьте заявку боту'
        ]);

        // Yangi
        Permission::create([
            'name' => 'add.user',
            'name_menyu' => 'Отдел кадров, Добавить сотрудник'
        ]);

        Permission::create([
            'name' => 'update.role',
            'name_menyu' => 'Отдел кадров, Изменить роль'
        ]);

        Permission::create([
            'name' => 'role',
            'name_menyu' => 'Отдел кадров, Поиск роль'
        ]);

        Permission::create([
            'name' => 'role.create',
            'name_menyu' => 'Отдел кадров, Добавить роль'
        ]);

        Permission::create([
            'name' => 'role.update',
            'name_menyu' => 'Отдел кадров, Обновить роль'
        ]);

        Permission::create([
            'name' => 'role.delete',
            'name_menyu' => 'Отдел кадров, Удалить роль'
        ]);

        Permission::create([
            'name' => 'admin',
            'name_menyu' => 'Окно администратора'
        ]);

        Permission::create([
            'name' => 'status_failed',
            'name_menyu' => 'Админ, Заявка отменена'
        ]);

        Permission::create([
            'name' => 'send_to_production',
            'name_menyu' => 'Админ, Отправить в производство'
        ]);

        Permission::create([
            'name' => 'status_all',
            'name_menyu' => 'Админ, Заявка статус'
        ]);

        Permission::create([
            'name' => 'status',
            'name_menyu' => 'Отдел продаж, Обновить статус'
        ]);

        Permission::create([
            'name' => 'tabel',
            'name_menyu' => 'Отдел кадров, Табел'
        ]);

        Permission::create([
            'name' => 'tabels.store',
            'name_menyu' => 'Отдел кадров, Добавить табел дата'
        ]);

        Permission::create([
            'name' => 'tabels.date',
            'name_menyu' => 'Отдел кадров, Фильтр табел'
        ]);

        // Ishlab chiqaruvchi
        $p1 =  Permission::create([
            'name' => 'order_app.list',
            'name_menyu' => 'Производитель, Входящие заявки'
        ]);

        $p2 = Permission::create([
            'name' => 'order_app.status',
            'name_menyu' => 'Производитель, Статус входящие заявки'
        ]);

        $p3 = Permission::create([
            'name' => 'order_app.create',
            'name_menyu' => 'Производитель, Производство продукта'
        ]);

        $p4 = Permission::create([
            'name' => 'order_app.show',
            'name_menyu' => 'Производитель, Посмотреть подробности продукта'
        ]);
        // Ishlab chiqaruvchi

        Permission::create([
            'name' => 'shot.factura',
            'name_menyu' => 'Бугалтер, Счёт-фактура'
        ]);

        Permission::create([
            'name' => 'rashod',
            'name_menyu' => 'Бугалтер, Список расходы'
        ]);

        Permission::create([
            'name' => 'rashod.add',
            'name_menyu' => 'Бугалтер, Добавить расходы'
        ]);

        Permission::create([
            'name' => 'statusRashor',
            'name_menyu' => 'Бугалтер, Статус расходы'
        ]);

        Permission::create([
            'name' => 'rashodStatus',
            'name_menyu' => 'Админ, Статус расходы администратора'
        ]);

        Permission::create([
            'name' => 'addRasxod',
            'name_menyu' => 'Бугалтер, Добавить расходы'
        ]);


        $user->assignRole('Супер администратор');

        $user1->assignRole('Отдел кадров');

        $user2->assignRole('Бугалтер');

        $user3->assignRole('Отдел продаж');

        $user4->assignRole('Производитель');

        $user5->assignRole('Менеджер склада');

        $user6->assignRole('Машинист');

        $user7->assignRole('Курьер');

        $user8->assignRole('Механик');

        $permissions = Permission::all();

        $per1 = Permission::whereIn('id', [16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 38, 39, 40, 41, 42, 43, 44, 111, 114, 115, 121])->get();
        $per2 = Permission::whereIn('id', [42,44,45,46,47,48,128,129,130,131,132,133,])->get();
        $per4 = Permission::whereIn('id', [$p1->id, $p2->id, $p3->id, $p4->id, $p5->id, $p6->id, $p7->id, $p8->id, $p9->id, $p10->id, $p11->id, $p12->id, $p13->id, $p14->id, $p15->id, $p16->id, $p17->id, $p18->id, $p19->id])->get();
        $zak8 = Permission::whereIn('id', [$z1->id, $z2->id, $z3->id])->get();
        $role4->givePermissionTo($per4);
        $role8->givePermissionTo($zak8);

        $role->givePermissionTo($permissions);
        $role1->givePermissionTo($per1);
        $role2->givePermissionTo($permissions);
        $role3->givePermissionTo($permissions);
        $role5->givePermissionTo($permissions);
        $role6->givePermissionTo($permissions);
        $role7->givePermissionTo($permissions);


        Type::create(['name' => 'Avans']);
        Type::create(['name' => 'Oylik']);
        Type::create(['name' => 'KPI']);
        Type::create(['name' => 'Boshqa']);

        Unit::create(['name' => 'T']);
        Unit::create(['name' => 'KG']);
        Unit::create(['name' => 'GR']);
        Unit::create(['name' => 'M']);
        Unit::create(['name' => 'SM']);
        Unit::create(['name' => 'MM']);

        // Oylik

        Salary_Type::create([
            'name' => 'Xaftalik'
        ]);
        Salary_Type::create([
            'name' => 'Oylik'
        ]);
        Salary_Type::create([
            'name' => 'KPI'
        ]);

        // Mijos
        Customer::create([
            'name' => 'Mijoz 1',
            'phone1' => '+998941050405',
        ]);
        Customer::create([
            'name' => 'Mijoz 2',
            'phone1' => '+998941050406',
        ]);

        // Bo'limlar
        Department::create([
            'name' => 'Bugalterya'
        ]);

        Department::create([
            'name' => 'Sotuv bo`lim'
        ]);
        Department::create([
            'name' => 'Curyer'
        ]);
        // Material_Category

        MaterialStok::create([
            'name' => 'Ombor 1',
            'user_id' => 2,
            'status' => 1,
        ]);

        MaterialStok::create([
            'name' => 'Ombor 2',
            'user_id' => 3,
            'status' => 1,
        ]);

        ProductStok::create([
            'name' => 'ProductStok - 1',
            'user_id' => 1,
        ]);

        ProductStok::create([
            'name' => 'ProductStok - 2',
            'user_id' => 2,
        ]);

        ProductStok::create([
            'name' => 'ProductStok - 3',
            'user_id' => 3,
        ]);

        Discounts::create(['name' => '10']);
        Discounts::create(['name' => '20']);
        Discounts::create(['name' => '30']);
        Discounts::create(['name' => '30']);
    }
}
