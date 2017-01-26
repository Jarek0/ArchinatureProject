<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');//all x
            $table->string('name');//all x
            $table->string('surname');//all x
            $table->string('phone');//all x
            $table->string('email')->unique();//all x
            $table->string('password');//all x

            $table->enum('user_type', ['student', 'phdstudent', 'graduate', 'guardian']);//all x

            $table->rememberToken();//all x
            $table->timestamps();//all x
            $table->boolean('verified')->default(false);//all x
            $table->boolean('banned')->default(false);//all x
            $table->string('token')->nullable();//all x
            $table->date('last_logged');//all x

            $table->string('school');//all x
            $table->string('school_field_of_study')->nullable();// S P Gr x
            $table->string('school_institute')->nullable();//Gu x
            $table->string('school_establishment')->nullable();//Gu x
            $table->string('school_degree')->nullable();//S x

            $table->boolean('science_club')->nullable();//S x
            $table->string('science_club_name')->nullable();//S G x
            $table->string('science_club_email')->nullable();//S G x
            $table->string('science_club_page')->nullable();//S G x
            $table->enum('science_club_function', ['member', 'board_member','chairman'])->nullable();//S x
            $table->string('science_club_guardian')->nullable();//S x
            $table->string('science_club_information')->nullable();//S G x

            $table->boolean('accompanying_person');//all x
            $table->string('accompanying_person_name')->nullable();//all x
            $table->string('accompanying_person_surname')->nullable();//all x
            $table->string('accompanying_person_email')->nullable();//all x

            $table->boolean('company')->nullable();//Gr x
            $table->string('company_profile')->nullable();//Gr x
            $table->string('company_name')->nullable();//Gr x
            $table->string('company_address')->nullable();//Gr x
            $table->string('company_nip')->nullable();//Gr x

            $table->boolean('facture')->nullable();//Gr Ph x
            $table->string('facture_information')->nullable();//Gr Ph x

            $table->boolean('employee_universities')->nullable();//Ph

            $table->string('refer_theme');//all x
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
