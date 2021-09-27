<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class DB_Seed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ADMIN_PROFILE')->insert([
            //'email' => 'jboelhouwer@upei.ca',
            'username' => 'Minhajur2021',
            'password' => Hash::make('olympic2021'),
            'FirstName' => 'Minhajur',
            'LastName' => 'Rahman',
            'RootAdmin' => true
        ]);

        DB::table('CAREGIVER_PROFILE')->insert([
            //'email' => 'jboelhouwer@upei.ca',
            'username' => 'Caregiver2021',
            'password' => Hash::make('olympic2021'),
            'FirstName' => 'Olympic',
            'LastName' => 'Caregiver',
            'Rootcaregiver' => true
        ]);

        /*DB::table('ADMIN_PROFILE')->insert([
            'email' => 'mrahman2@upei.ca',
            'password' => Hash::make('minhajPass'),
            'FirstName' => 'Minhajur',
            'LastName' => 'Rahman',
            'RootAdmin' => true
        ]);

        DB::table('ADMIN_PROFILE')->insert([
            'email' => 'shindawi@upei.ca',
            'password' => Hash::make('saraPass'),
            'FirstName' => 'Sara',
            'LastName' => 'Hindawi',
            'RootAdmin' => true
        ]);

        DB::table('ADMIN_PROFILE')->insert([
            'email' => 'nmayaleh@upei.ca',
            'password' => Hash::make('nairouzPass'),
            'FirstName' => 'Nairouz',
            'LastName' => 'Mayaleh',
            'RootAdmin' => true
        ]);

        DB::table('ADMIN_PROFILE')->insert([
            'email' => 'mmayaleh@upei.ca',
            'password' => Hash::make('majdPass'),
            'FirstName' => 'Majd',
            'LastName' => 'Mayaleh',
            'RootAdmin' => true
        ]);

        DB::table('ADMIN_PROFILE')->insert([
            'email' => 'jsethdavid@upei.ca ',
            'password' => Hash::make('jessiePass'),
            'FirstName' => 'Jessie',
            'LastName' => 'Sethdavid',
            'RootAdmin' => true
        ]);

        DB::table('ADMIN_PROFILE')->insert([
            'email' => 'testadmin@test.ca',
            'password' => Hash::make('adminPass'),
            'FirstName' => 'TestAdminFirst',
            'LastName' => 'TestAdminLast',
            'RootAdmin' => false
        ]);*/

        /*DB::table('CONDITION_LIST')->insert([
            'Condition' => 'IBD'
        ]);


        DB::table('MEDICATION_LIST')->insert([
            'MedicationName' => 'Oral Steroids (Prendisone, Budesonide)'
        ]);

        DB::table('MEDICATION_LIST')->insert([
            'MedicationName' => 'Rectal Steroids'
        ]);

        DB::table('MEDICATION_LIST')->insert([
            'MedicationName' => 'Oral 5-ASA or Sulfasalazine (Pentasa, Asacol, Salofalk etc)'
        ]);

        DB::table('MEDICATION_LIST')->insert([
            'MedicationName' => 'Rectal 5-ASA (enemas,suppositories or foam- Salofalk)'
        ]);

        DB::table('MEDICATION_LIST')->insert([
            'MedicationName' => 'Azathioprine'
        ]);

        DB::table('MEDICATION_LIST')->insert([
            'MedicationName' => 'Mercaptopurine'
        ]);

        DB::table('MEDICATION_LIST')->insert([
            'MedicationName' => 'Methortrexate'
        ]);

        DB::table('MEDICATION_LIST')->insert([
            'MedicationName' => 'Ustekinumab (Stelara)'
        ]);

        DB::table('MEDICATION_LIST')->insert([
            'MedicationName' => 'Vedolizumab (Entyvio)'
        ]);

        DB::table('MEDICATION_LIST')->insert([
            'MedicationName' => 'Adalimumab (Humira)'
        ]);

        DB::table('MEDICATION_LIST')->insert([
            'MedicationName' => 'Infliximab (Remicade)'
        ]);

        DB::table('MEDICATION_LIST')->insert([
            'MedicationName' => 'Golimumab (Simponi)'
        ]);

        DB::table('MEDICATION_LIST')->insert([
            'MedicationName' => 'Biosimilars'
        ]);

        DB::table('MEDICATION_LIST')->insert([
            'MedicationName' => 'Tofacitinib'
        ]);*/

        /*DB::table('PARTCIPANT_PROFILE')->insert([
            'email' => 'jboelhouwer@upei.ca',
            'password' => Hash::make('patientOne'),
            'FirstName' => 'TestPatientOneFirst',
            'LastName' => 'TestPatientOneLast',
            'DOB' => date_create("30-01-1990"),
            'Gender' => 'Male',
            'Weight' => 240,
            'Height' => 160,
            'Condition' =>'IBD',
            'Medications' => json_encode(array('Test Medication 1', 'Test Medication 4')),
            'PREMFlag' => true,
            'PROMFlag' => true,
            'NewAccount' => false,
            'PasswordReset' => "false",
        ]);**/

        /*DB::table('PATIENT_PROFILE')->insert([
            'Email' => 'testpatientotwo@test.ca',
            'Password' => Hash::make('patientTwo'),
            'FirstName' => 'TestPatienttwoFirst',
            'LastName' => 'TestPatienttwoLast',
            'DOB' => date_create("12-01-2000"),
            'Gender' => 'Female',
            'Weight' => 180,
            'Height' => 170,
            'Condition' =>'IBD',
            'Medications' => json_encode(array('Test Medication 2')),
            'PREMFlag' => true,
            'PROMFlag' => true,
            'NewAccount' => true,
            'PasswordReset' => "false",
            ]);**/

            DB::table('PARTICIPANT_PROFILE')->insert([
                'username' => 'John2021',
                'Password' => Hash::make('olympic2021'),
                'FirstName' => 'John',
                'LastName' => 'Doe',
                'DOB' => date_create("12-01-2000"),
                'Gender' => 'male',
                'PasswordReset' => "false",
                ]);

            

        $SEquestions = array(array('Text' => 'Do you think that you can make time for your goal almost everyday?'
                                     , 'Type' => 'RadioButtons' , 'PossibleResponses' => 'no(0),maybe(1),yes(2)'),
                          array('Text' => 'Do you think that you can work on your goal even when you are very busy?'
                                     , 'Type' => 'RadioButtons' , 'PossibleResponses' => 'no(0),maybe(1),yes(2)'),
                          array('Text' => 'Do you think that you can work on your goal even when you are feeling sad or depressed?'
                                     , 'Type' => 'RadioButtons' , 'PossibleResponses' => 'no(0),maybe(1),yes(2)'),
                          array('Text' => 'Do you think that you can work on your goal even after a long, hard day at work?'
                                     , 'Type' => 'RadioButtons' , 'PossibleResponses' => 'no(0),maybe(1),yes(2)'),
                          array('Text' => 'Do you think that you can work on your goal on days when you are tired or don’t have much energy?'
                                     , 'Type' => 'RadioButtons' , 'PossibleResponses' => 'no(0),maybe(1),yes(2)'),
                          array('Text' => 'Do you think you can do your goal when you feel lazy?'
                                     , 'Type' => 'RadioButtons' , 'PossibleResponses' => 'no(0),maybe(1),yes(2)'),
                        );

        $SSAIDquestions = array(array('Text' => 'Does anyone in your family remind you to work on your goal?'
                                     , 'Type' => 'RadioButtons' , 'PossibleResponses' => 'no(0),yes-sometimes(1),yes-alot(2)'),
                          array('Text' => 'Does anyone in your family work on your goal with you?'
                                     , 'Type' => 'RadioButtons' , 'PossibleResponses' => 'no(0),yes-sometimes(1),yes-alot(2)'),
                          array('Text' => 'Does anyone in your family plan to work on your goal when you spend time with them?'
                                     , 'Type' => 'RadioButtons' , 'PossibleResponses' => 'no(0),yes-sometimes(1),yes-alot(2)'),
                          array('Text' => 'Does anyone in your family show you how to work on your goal?'
                                     , 'Type' => 'RadioButtons' , 'PossibleResponses' => 'no(0),yes-sometimes(1),yes-alot(2)'),
                          array('Text' => 'Does anyone in your family tell you that you are good at your goal?'
                                     , 'Type' => 'RadioButtons' , 'PossibleResponses' => 'no(0),yes-sometimes(1),yes-alot(2)'),
                          array('Text' => 'Does anyone in your family pay for you to learn new skills somewhere or buy you things that you need to work on your goal?'
                                     , 'Type' => 'RadioButtons' , 'PossibleResponses' => 'no(0),yes-sometimes(1),yes-alot(2)'),
                           array('Text' => 'Does anyone in your family drive you somewhere to learn new skills when you need them to?'
                                     , 'Type' => 'RadioButtons' , 'PossibleResponses' => 'no(0),yes-sometimes(1),yes-alot(2)'),
                        );

        DB::table('SURVEY_QUESTIONS')->insert([
            'SurveyName' => 'Self-Efficacy Social Support Scale for Activity for persons with Intellectual Disability',
            'SurveyQuestions' => json_encode($SEquestions)
        ]);

     

        DB::table('SURVEY_QUESTIONS')->insert([
            'SurveyName' => 'Social support for activity for persons with intellectual disabilities (SS‐AID) family scale',
            'SurveyQuestions' => json_encode($SSAIDquestions)
        ]);


    }
}