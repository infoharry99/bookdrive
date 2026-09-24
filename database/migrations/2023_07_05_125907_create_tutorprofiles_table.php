    <?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tutorprofiles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('mobile');
            $table->bigInteger('secondary_mobile')->nullable();
            $table->string('email')->unique();
            $table->string('goal')->nullable();
            $table->string('qualification');
            $table->string('intro_video_link')->nullable();
            $table->string('profile_pic')->nullable();
            $table->string('rate')->nullable();
            $table->string('expertise')->nullable();
            $table->string('experience')->nullable();
            $table->string('certification')->nullable();
            $table->string('headline')->nullable();
            $table->string('detail_1')->nullable();
            $table->string('detail_2')->nullable();
            $table->string('detail_3')->nullable();
            $table->integer('tutor_id');
            $table->string('keywords')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tutorprofiles');
    }
};
