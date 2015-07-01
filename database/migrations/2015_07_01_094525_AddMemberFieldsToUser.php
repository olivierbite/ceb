<?php

use Illuminate\Database\Migrations\Migration;

class AddMemberFieldsToUser extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {

		// Add the Member fields to the users table
		Schema::table('users', function ($table) {

			$table->integer('adhesion_id')->nullable()->unique();
			$table->integer('savings_contract_id')->nullable();
			$table->string('date_of_birth')->nullable();
			$table->string('district')->nullable();
			$table->string('province')->nullable();
			$table->string('sex')->nullable();
			$table->string('member_nid')->nullable();
			$table->string('telephone')->nullable();
			$table->timestamp('departure_date')->nullable();
			$table->string('institution')->nullable();
			$table->string('service')->nullable();
			$table->decimal('monthly_fee', 10, 2)->nullable();
			$table->string('attorney')->nullable();
			$table->string('photo')->nullable();
			$table->string('signature')->nullable();
			$table->string('attorney_image')->nullable();
			$table->string('attorney_signature')->nullable();
			$table->string('status')->nullable();

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		// Remove member fields from the users table
		Schema::table('users', function ($table) {
			$table->dropColumn('adhesion_id');
			$table->dropColumn('savings_contract_id');
			$table->dropColumn('date_of_birth');
			$table->dropColumn('district');
			$table->dropColumn('province');
			$table->dropColumn('sex');
			$table->dropColumn('member_nid');
			$table->dropColumn('telephone');
			$table->dropColumn('adhesion_date');
			$table->dropColumn('departure_date');
			$table->dropColumn('institution');
			$table->dropColumn('service');
			$table->dropColumn('monthly_fee');
			$table->dropColumn('attorney');
			$table->dropColumn('photo');
			$table->dropColumn('signature');
			$table->dropColumn('attorney_image');
			$table->dropColumn('attorney_signature');
			$table->dropColumn('status');
		});
	}
}
