<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Project;
use App\Models\Skill;
use App\Models\SocialLink;
use App\Models\SiteSetting;

class AdminSeeder extends Seeder {
    public function run(): void {
        // Admin user
        User::updateOrCreate(['email' => 'admin@akbarmaulana.dev'], [
            'name' => 'Akbar Maulana',
            'password' => Hash::make('Admin@2024!'),
            'is_admin' => true,
        ]);

        // Site Settings
        $settings = [
            ['key'=>'hero_name','value'=>'Akbar Maulana','group'=>'hero'],
            ['key'=>'hero_tagline','value'=>'Information System Security Enthusiast & Full-Stack Web Developer','group'=>'hero'],
            ['key'=>'hero_terminal_1','value'=>'> System_Ready: Securing the Web & Building the Future.','group'=>'hero'],
            ['key'=>'hero_terminal_2','value'=>'> Bug found? Consider it fixed. 🔐','group'=>'hero'],
            ['key'=>'hero_terminal_3','value'=>'> One Commit at a Time. 🚀','group'=>'hero'],
            ['key'=>'about_description','value'=>'Mahasiswa Keamanan Sistem Informasi di Politeknik Negeri Bengkalis. Memiliki fokus pada manual penetration testing, bug bounty, dan pengembangan aplikasi web yang aman.','group'=>'about'],
            ['key'=>'about_location','value'=>'Bengkalis, Riau','group'=>'about'],
            ['key'=>'about_institution','value'=>'Poltek Negeri Bengkalis','group'=>'about'],
            ['key'=>'about_focus','value'=>'Cybersecurity & Dev','group'=>'about'],
            ['key'=>'whatsapp_number','value'=>'089636926578','group'=>'contact'],
            ['key'=>'email_address','value'=>'akbarmaulana@dev.id','group'=>'contact'],
        ];
        foreach ($settings as $s) {
            SiteSetting::updateOrCreate(['key'=>$s['key']], ['value'=>$s['value'],'group'=>$s['group']]);
        }

        // Social Links
        $links = [
            ['platform'=>'GitHub','emoji'=>'🐙','label'=>'github.com/akbarmaulana','url'=>'https://github.com/akbarmaulana','accent_color'=>'#00d4ff','sort_order'=>1],
            ['platform'=>'LinkedIn','emoji'=>'💼','label'=>'Akbar Maulana','url'=>'https://linkedin.com/in/akbarmaulana','accent_color'=>'#0ea5e9','sort_order'=>2],
            ['platform'=>'Instagram','emoji'=>'📸','label'=>'@akbarmaulana','url'=>'https://instagram.com/akbarmaulana','accent_color'=>'#e1306c','sort_order'=>3],
            ['platform'=>'WhatsApp','emoji'=>'💬','label'=>'+62 896-3692-6578','url'=>'https://wa.me/6289636926578','accent_color'=>'#25d366','sort_order'=>4],
            ['platform'=>'Email','emoji'=>'📧','label'=>'akbarmaulana@dev.id','url'=>'mailto:akbarmaulana@dev.id','accent_color'=>'#00ff88','sort_order'=>5],
        ];
        foreach ($links as $l) {
            SocialLink::updateOrCreate(['platform'=>$l['platform']], $l);
        }

        // Projects
        $projects = [
            ['emoji'=>'🎬','title'=>'JejakLayar','description'=>'Aplikasi web arsip digital berbasis peta interaktif. Dokumentasi dan katalog konten budaya dengan integrasi map.','tech_stack'=>'Laravel, Tailwind CSS, MySQL, Leaflet.js','tags'=>['Laravel','Tailwind','MySQL','Maps'],'accent_color'=>'#00d4ff','sort_order'=>1],
            ['emoji'=>'🏪','title'=>'Mall-UMKM','description'=>'Platform marketplace digital untuk UMKM lokal. Membantu pengusaha kecil menjangkau pasar lebih luas secara digital.','tech_stack'=>'Laravel, PHP, MySQL, Bootstrap','tags'=>['Laravel','E-Commerce','UMKM','PHP'],'accent_color'=>'#00ff88','sort_order'=>2],
            ['emoji'=>'🛡️','title'=>'Arunikacyber','description'=>'Tim layanan digital profesional menyediakan web design, hosting, dan solusi keamanan digital untuk klien.','tech_stack'=>'Web Design, Hosting, Security, Branding','tags'=>['CyberSec','WebDesign','Hosting','Branding'],'accent_color'=>'#b44fff','sort_order'=>3],
            ['emoji'=>'🏡','title'=>'PKM-PM Pangkalan Batang','description'=>'Proyek digitalisasi sistem manajemen desa dalam program PKM-PM. Modernisasi administrasi desa berbasis web.','tech_stack'=>'Laravel, PostgreSQL, Tailwind CSS','tags'=>['Laravel','PostgreSQL','Government','PKM'],'accent_color'=>'#f59e0b','sort_order'=>4],
        ];
        foreach ($projects as $p) {
            Project::updateOrCreate(['title'=>$p['title']], $p);
        }

        // Skills
        $skills = [
            ['category'=>'Web Development','category_emoji'=>'🌐','name'=>'Laravel','level'=>90,'color'=>'blue','sort_order'=>1],
            ['category'=>'Web Development','category_emoji'=>'🌐','name'=>'PHP Native','level'=>85,'color'=>'blue','sort_order'=>2],
            ['category'=>'Web Development','category_emoji'=>'🌐','name'=>'MySQL','level'=>80,'color'=>'blue','sort_order'=>3],
            ['category'=>'Web Development','category_emoji'=>'🌐','name'=>'Tailwind CSS','level'=>88,'color'=>'blue','sort_order'=>4],
            ['category'=>'Web Development','category_emoji'=>'🌐','name'=>'JavaScript','level'=>75,'color'=>'blue','sort_order'=>5],
            ['category'=>'Cybersecurity','category_emoji'=>'🔐','name'=>'Penetration Testing','level'=>85,'color'=>'green','sort_order'=>1],
            ['category'=>'Cybersecurity','category_emoji'=>'🔐','name'=>'Bug Bounty','level'=>78,'color'=>'green','sort_order'=>2],
            ['category'=>'Cybersecurity','category_emoji'=>'🔐','name'=>'Android Exploitation (AMYTH)','level'=>72,'color'=>'green','sort_order'=>3],
            ['category'=>'Cybersecurity','category_emoji'=>'🔐','name'=>'OSINT','level'=>75,'color'=>'green','sort_order'=>4],
            ['category'=>'Cybersecurity','category_emoji'=>'🔐','name'=>'Web App Security','level'=>88,'color'=>'green','sort_order'=>5],
            ['category'=>'Others','category_emoji'=>'🤖','name'=>'Machine Learning','level'=>65,'color'=>'purple','sort_order'=>1],
            ['category'=>'Others','category_emoji'=>'🤖','name'=>'Python','level'=>70,'color'=>'purple','sort_order'=>2],
            ['category'=>'Others','category_emoji'=>'🤖','name'=>'Git & GitHub','level'=>82,'color'=>'purple','sort_order'=>3],
            ['category'=>'Others','category_emoji'=>'🤖','name'=>'Linux CLI','level'=>80,'color'=>'purple','sort_order'=>4],
        ];
        foreach ($skills as $s) {
            Skill::updateOrCreate(['name'=>$s['name']], $s);
        }
    }
}
