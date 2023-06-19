<?php

namespace Database\Seeders;

use App\Models\Specialist;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateSpecialistsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run() : void
    {

        $data = [
            [
                'name_ar' => 'طب الطوارئ والحوادث',
                'name_en' => 'Accident and emergency medicine',
            ],
            [
                'name_ar' => 'علم الحساسية',
                'name_en' => 'Allergology',
            ],
            [
                'name_ar' => 'التخدير',
                'name_en' => 'Anaesthetics',
            ],
            [
                'name_ar' => 'الأمراض الدموية الحيوية',
                'name_en' => 'Biological hematology',
            ],
            [
                'name_ar' => 'أمراض القلب',
                'name_en' => 'Cardiology',
            ],
            [
                'name_ar' => 'طب الأطفال النفسي',
                'name_en' => 'Child psychiatry',
            ],
            [
                'name_ar' => 'الأحياء السريرية',
                'name_en' => 'Clinical biology',
            ],
            [
                'name_ar' => 'الكيمياء السريرية',
                'name_en' => 'Clinical chemistry',
            ],
            [
                'name_ar' => 'العلم العصبي الفيزيولوجي السريري',
                'name_en' => 'Clinical neurophysiology',
            ],
            [
                'name_ar' => 'التصوير الطبي السريري',
                'name_en' => 'Clinical radiology',
            ],
            [
                'name_ar' => 'جراحة الأسنان والفم والوجه',
                'name_en' => 'Dental, oral and maxillo-facial surgery',
            ],
            [
                'name_ar' => 'أمراض الجلد والأمراض الجنسية',
                'name_en' => 'Dermato-venerology',
            ],
            [
                'name_ar' => 'أمراض الجلدية',
                'name_en' => 'Dermatology',
            ],
            [
                'name_ar' => 'علم الغدد الصماء',
                'name_en' => 'Endocrinology',
            ],
            [
                'name_ar' => 'جراحة الجهاز الهضمي',
                'name_en' => 'Gastro-enterologic surgery',
            ],
            [
                'name_ar' => 'أمراض المعدة والأمعاء',
                'name_en' => 'Gastroenterology',
            ],
            [
                'name_ar' => 'الأمراض الدموية العامة',
                'name_en' => 'General hematology',
            ],
            [
                'name_ar' => 'الطب العام',
                'name_en' => 'General Practice',
            ],
            [
                'name_ar' => 'جراحة عامة',
                'name_en' => 'General surgery',
            ],
            [
                'name_ar' => 'طب المسنين',
                'name_en' => 'Geriatrics',
            ],
            [
                'name_ar' => 'مناعة' ,
                'name_en' => 'Immunology',
            ],
            [
                'name_ar' => 'الأمراض المعدية',
                'name_en' => 'Infectious diseases',
            ],
            [
                'name_ar' => 'الطب الباطني',
                'name_en' => 'Internal medicine',
            ],
            [
                'name_ar' => 'طب المختبرات',
                'name_en' => 'Laboratory medicine',
            ],
            [
                'name_ar' => 'جراحة الفك والوجه',
                'name_en' => 'Maxillo-facial surgery',
            ],
            [
                'name_ar' => 'علم الأحياء الدقيقة',
                'name_en' => 'Microbiology',
            ],
            [
                'name_ar' => 'أمراض الكلى',
                'name_en' => 'Nephrology',
            ],
            [
                'name_ar' => 'أمراض الأعصاب والطب النفسي' ,
                'name_en' => 'Neuro-psychiatry',
            ],
            [
                'name_ar' => 'أمراض الأعصاب',
                'name_en' => 'Neurology',
            ],
            [
                'name_ar' => 'جراحة الأعصاب',
                'name_en' => 'Neurosurgery',
            ],
            [
                'name_ar' => 'الطب النووي',
                'name_en' => 'Nuclear medicine',
            ],
            [
                'name_ar' => 'النسا والتوليد',
                'name_en' => 'Obstetrics and gynecology',
            ],
            [
                'name_ar' => 'طب العمل',
                'name_en' => 'Occupational medicine',
            ],
            [
                'name_ar' => 'طب العيون',
                'name_en' => 'Ophthalmology',
            ],
            [
                'name_ar' => 'جراحة العظام',
                'name_en' => 'Orthopaedics',
            ],
            [
                'name_ar' => 'أمراض الأنف والأذن والحنجرة',
                'name_en' => 'Otorhinolaryngology',
            ],
            [
                'name_ar' => 'جراحة الأطفال',
                'name_en' => 'Paediatric surgery',
            ],
            [
                'name_ar' => 'طب الأطفال',
                'name_en' => 'Paediatrics',
            ],
            [
                'name_ar' => 'علم المرض',
                'name_en' => 'Pathology',
            ],
            [
                'name_ar' => 'علم الأدوية',
                'name_en' => 'Pharmacology',
            ],
            [
                'name_ar' => 'الطب الطبيعي وإعادة التأهيل',
                'name_en' => 'Physical medicine and rehabilitation',
            ],
            [
                'name_ar' => 'جراحة التجميل',
                'name_en' => 'Plastic surgery',
            ],
            [
                'name_ar' => 'طب القدمين',
                'name_en' => 'Podiatric Medicine',
            ],
            [
                'name_ar' => 'جراحة القدمين',
                'name_en' => 'Podiatric Surgery',
            ],
            [
                'name_ar' => 'طب النفس',
                'name_en' => 'Psychiatry',
            ],
            [
                'name_ar' => 'الصحة العامة والوقاية',
                'name_en' => 'Public health and Preventive Medicine',
            ],
            [
                'name_ar' => 'التصوير الطبي',
                'name_en' => 'Radiology',
            ],
            [
                'name_ar' => 'العلاج الإشعاعي',
                'name_en' => 'Radiotherapy',
            ],
            [
                'name_ar' => 'أمراض الجهاز التنفسي',
                'name_en' => 'Respiratory medicine',
            ],
            [
                'name_ar' => 'الروماتيزم',
                'name_en' => 'Rheumatology',
            ],
            [
                'name_ar' => 'طب الفم والأسنان',
                'name_en' => 'Stomatology',
            ],
            [
                'name_ar' => 'جراحة الصدر',
                'name_en' => 'Thoracic surgery',
            ],
            [
                'name_ar' => 'طب الأمراض الاستوائية',
                'name_en' => 'Tropical medicine',
            ],
            [
                'name_ar' => 'جراحة المسالك البولية',
                'name_en' => 'Urology',
            ],
            [
                'name_ar' => 'جراحة الأوعية الدموية',
                'name_en' => 'Vascular surgery',
            ],
            [
                'name_ar' => 'أمراض الجنس',
                'name_en' => 'Venereology',
            ],
        ];

        foreach ($data as $specialist) {
            Specialist::create([
                'name_ar' => $specialist['name_ar'],
                'name_en' => $specialist['name_en'],
            ]);
        }
    }
}

