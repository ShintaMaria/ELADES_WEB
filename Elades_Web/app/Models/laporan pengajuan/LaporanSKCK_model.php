<php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanSKCK extends Model
{
    use HasFactory;
    
    protected $table = 'laporan_skck'; // Nama tabel
    protected $fillable = ['status', 'pengajuan', 'alasan', 'alamat']; // Kolom yang bisa diisi
}
