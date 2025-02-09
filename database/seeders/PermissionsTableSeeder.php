<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'country_create',
            ],
            [
                'id'    => 18,
                'title' => 'country_edit',
            ],
            [
                'id'    => 19,
                'title' => 'country_show',
            ],
            [
                'id'    => 20,
                'title' => 'country_delete',
            ],
            [
                'id'    => 21,
                'title' => 'country_access',
            ],
            [
                'id'    => 22,
                'title' => 'province_create',
            ],
            [
                'id'    => 23,
                'title' => 'province_edit',
            ],
            [
                'id'    => 24,
                'title' => 'province_show',
            ],
            [
                'id'    => 25,
                'title' => 'province_delete',
            ],
            [
                'id'    => 26,
                'title' => 'province_access',
            ],
            [
                'id'    => 27,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 28,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 29,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 30,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 31,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 32,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 33,
                'title' => 'basic_c_r_m_access',
            ],
            [
                'id'    => 34,
                'title' => 'crm_status_create',
            ],
            [
                'id'    => 35,
                'title' => 'crm_status_edit',
            ],
            [
                'id'    => 36,
                'title' => 'crm_status_show',
            ],
            [
                'id'    => 37,
                'title' => 'crm_status_delete',
            ],
            [
                'id'    => 38,
                'title' => 'crm_status_access',
            ],
            [
                'id'    => 39,
                'title' => 'crm_customer_create',
            ],
            [
                'id'    => 40,
                'title' => 'crm_customer_edit',
            ],
            [
                'id'    => 41,
                'title' => 'crm_customer_show',
            ],
            [
                'id'    => 42,
                'title' => 'crm_customer_delete',
            ],
            [
                'id'    => 43,
                'title' => 'crm_customer_access',
            ],
            [
                'id'    => 44,
                'title' => 'crm_note_create',
            ],
            [
                'id'    => 45,
                'title' => 'crm_note_edit',
            ],
            [
                'id'    => 46,
                'title' => 'crm_note_show',
            ],
            [
                'id'    => 47,
                'title' => 'crm_note_delete',
            ],
            [
                'id'    => 48,
                'title' => 'crm_note_access',
            ],
            [
                'id'    => 49,
                'title' => 'crm_document_create',
            ],
            [
                'id'    => 50,
                'title' => 'crm_document_edit',
            ],
            [
                'id'    => 51,
                'title' => 'crm_document_show',
            ],
            [
                'id'    => 52,
                'title' => 'crm_document_delete',
            ],
            [
                'id'    => 53,
                'title' => 'crm_document_access',
            ],
            [
                'id'    => 54,
                'title' => 'faq_management_access',
            ],
            [
                'id'    => 55,
                'title' => 'faq_category_create',
            ],
            [
                'id'    => 56,
                'title' => 'faq_category_edit',
            ],
            [
                'id'    => 57,
                'title' => 'faq_category_show',
            ],
            [
                'id'    => 58,
                'title' => 'faq_category_delete',
            ],
            [
                'id'    => 59,
                'title' => 'faq_category_access',
            ],
            [
                'id'    => 60,
                'title' => 'faq_question_create',
            ],
            [
                'id'    => 61,
                'title' => 'faq_question_edit',
            ],
            [
                'id'    => 62,
                'title' => 'faq_question_show',
            ],
            [
                'id'    => 63,
                'title' => 'faq_question_delete',
            ],
            [
                'id'    => 64,
                'title' => 'faq_question_access',
            ],
            [
                'id'    => 65,
                'title' => 'task_management_access',
            ],
            [
                'id'    => 66,
                'title' => 'task_status_create',
            ],
            [
                'id'    => 67,
                'title' => 'task_status_edit',
            ],
            [
                'id'    => 68,
                'title' => 'task_status_show',
            ],
            [
                'id'    => 69,
                'title' => 'task_status_delete',
            ],
            [
                'id'    => 70,
                'title' => 'task_status_access',
            ],
            [
                'id'    => 71,
                'title' => 'task_tag_create',
            ],
            [
                'id'    => 72,
                'title' => 'task_tag_edit',
            ],
            [
                'id'    => 73,
                'title' => 'task_tag_show',
            ],
            [
                'id'    => 74,
                'title' => 'task_tag_delete',
            ],
            [
                'id'    => 75,
                'title' => 'task_tag_access',
            ],
            [
                'id'    => 76,
                'title' => 'task_create',
            ],
            [
                'id'    => 77,
                'title' => 'task_edit',
            ],
            [
                'id'    => 78,
                'title' => 'task_show',
            ],
            [
                'id'    => 79,
                'title' => 'task_delete',
            ],
            [
                'id'    => 80,
                'title' => 'task_access',
            ],
            [
                'id'    => 81,
                'title' => 'tasks_calendar_access',
            ],
            [
                'id'    => 82,
                'title' => 'definition_access',
            ],
            [
                'id'    => 83,
                'title' => 'setting_edit',
            ],
            [
                'id'    => 84,
                'title' => 'setting_access',
            ],
            [
                'id'    => 85,
                'title' => 'content_management_access',
            ],
            [
                'id'    => 86,
                'title' => 'content_category_create',
            ],
            [
                'id'    => 87,
                'title' => 'content_category_edit',
            ],
            [
                'id'    => 88,
                'title' => 'content_category_show',
            ],
            [
                'id'    => 89,
                'title' => 'content_category_delete',
            ],
            [
                'id'    => 90,
                'title' => 'content_category_access',
            ],
            [
                'id'    => 91,
                'title' => 'content_tag_create',
            ],
            [
                'id'    => 92,
                'title' => 'content_tag_edit',
            ],
            [
                'id'    => 93,
                'title' => 'content_tag_show',
            ],
            [
                'id'    => 94,
                'title' => 'content_tag_delete',
            ],
            [
                'id'    => 95,
                'title' => 'content_tag_access',
            ],
            [
                'id'    => 96,
                'title' => 'content_page_create',
            ],
            [
                'id'    => 97,
                'title' => 'content_page_edit',
            ],
            [
                'id'    => 98,
                'title' => 'content_page_show',
            ],
            [
                'id'    => 99,
                'title' => 'content_page_delete',
            ],
            [
                'id'    => 100,
                'title' => 'content_page_access',
            ],
            [
                'id'    => 101,
                'title' => 'team_create',
            ],
            [
                'id'    => 102,
                'title' => 'team_edit',
            ],
            [
                'id'    => 103,
                'title' => 'team_show',
            ],
            [
                'id'    => 104,
                'title' => 'team_delete',
            ],
            [
                'id'    => 105,
                'title' => 'team_access',
            ],
            [
                'id'    => 106,
                'title' => 'building_create',
            ],
            [
                'id'    => 107,
                'title' => 'building_edit',
            ],
            [
                'id'    => 108,
                'title' => 'building_show',
            ],
            [
                'id'    => 109,
                'title' => 'building_delete',
            ],
            [
                'id'    => 110,
                'title' => 'building_access',
            ],
            [
                'id'    => 111,
                'title' => 'unit_create',
            ],
            [
                'id'    => 112,
                'title' => 'unit_edit',
            ],
            [
                'id'    => 113,
                'title' => 'unit_show',
            ],
            [
                'id'    => 114,
                'title' => 'unit_delete',
            ],
            [
                'id'    => 115,
                'title' => 'unit_access',
            ],
            [
                'id'    => 116,
                'title' => 'contract_create',
            ],
            [
                'id'    => 117,
                'title' => 'contract_edit',
            ],
            [
                'id'    => 118,
                'title' => 'contract_show',
            ],
            [
                'id'    => 119,
                'title' => 'contract_delete',
            ],
            [
                'id'    => 120,
                'title' => 'contract_access',
            ],
            [
                'id'    => 121,
                'title' => 'maintenance_request_create',
            ],
            [
                'id'    => 122,
                'title' => 'maintenance_request_edit',
            ],
            [
                'id'    => 123,
                'title' => 'maintenance_request_show',
            ],
            [
                'id'    => 124,
                'title' => 'maintenance_request_delete',
            ],
            [
                'id'    => 125,
                'title' => 'maintenance_request_access',
            ],
            [
                'id'    => 126,
                'title' => 'amenity_create',
            ],
            [
                'id'    => 127,
                'title' => 'amenity_edit',
            ],
            [
                'id'    => 128,
                'title' => 'amenity_show',
            ],
            [
                'id'    => 129,
                'title' => 'amenity_delete',
            ],
            [
                'id'    => 130,
                'title' => 'amenity_access',
            ],
            [
                'id'    => 131,
                'title' => 'amenity_reservation_create',
            ],
            [
                'id'    => 132,
                'title' => 'amenity_reservation_edit',
            ],
            [
                'id'    => 133,
                'title' => 'amenity_reservation_show',
            ],
            [
                'id'    => 134,
                'title' => 'amenity_reservation_delete',
            ],
            [
                'id'    => 135,
                'title' => 'amenity_reservation_access',
            ],
            [
                'id'    => 136,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
