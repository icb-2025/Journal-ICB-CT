<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id
 * @property string $kode_perusahaan
 * @property string $nama_industri
 * @property string $bidang_usaha
 * @property string $alamat
 * @property string|null $no_telepon
 * @property string $nama_direktur
 * @property string $nama_pembimbing
 * @property int $input_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $kode_unik
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Perusahaan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Perusahaan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Perusahaan query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Perusahaan whereAlamat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Perusahaan whereBidangUsaha($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Perusahaan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Perusahaan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Perusahaan whereInputBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Perusahaan whereKodePerusahaan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Perusahaan whereNamaDirektur($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Perusahaan whereNamaIndustri($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Perusahaan whereNamaPembimbing($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Perusahaan whereNoTelepon($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Perusahaan whereUpdatedAt($value)
 */
	class Perusahaan extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $nama_lengkap
 * @property string $nis
 * @property string $tempat_lahir
 * @property string $tanggal_lahir
 * @property string|null $gol_darah
 * @property string $sekolah
 * @property string $alamat_sekolah
 * @property string|null $telepon_sekolah
 * @property string $nama_wali
 * @property string $alamat_wali
 * @property string|null $telepon_wali
 * @property int $input_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $guru
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Siswa newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Siswa newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Siswa query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Siswa whereAlamatSekolah($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Siswa whereAlamatWali($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Siswa whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Siswa whereGolDarah($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Siswa whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Siswa whereInputBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Siswa whereNamaLengkap($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Siswa whereNamaWali($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Siswa whereNis($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Siswa whereSekolah($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Siswa whereTanggalLahir($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Siswa whereTeleponSekolah($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Siswa whereTeleponWali($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Siswa whereTempatLahir($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Siswa whereUpdatedAt($value)
 */
	class Siswa extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $role
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

