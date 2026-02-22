<?php

namespace Database\Seeders;

use App\Models\SiteContent;
use Illuminate\Database\Seeder;

class SiteContentSeeder extends Seeder
{
    public function run(): void
    {
        $contents = [
            // Header (tüm sayfalarda)
            ['page' => 'header', 'key' => 'header_logo', 'label' => 'Header Logo', 'type' => 'image', 'value' => 'img/logo-default-slim.png', 'order' => 1],
            ['page' => 'header', 'key' => 'header_logo_alt', 'label' => 'Header Logo Alt Text', 'type' => 'text', 'value' => 'Denizli Teknik', 'order' => 2],
            ['page' => 'header', 'key' => 'nav_anasayfa', 'label' => 'Menü - Anasayfa', 'type' => 'text', 'value' => 'Anasayfa', 'order' => 10],
            ['page' => 'header', 'key' => 'nav_blog', 'label' => 'Menü - Blog', 'type' => 'text', 'value' => 'Blog', 'order' => 20],
            ['page' => 'header', 'key' => 'nav_hakkimizda', 'label' => 'Menü - Hakkımızda', 'type' => 'text', 'value' => 'Hakkımızda', 'order' => 30],
            ['page' => 'header', 'key' => 'nav_iletisim', 'label' => 'Menü - İletişim', 'type' => 'text', 'value' => 'İletişim', 'order' => 40],

            // Ana sayfa - Hero (üst banner)
            ['page' => 'home', 'key' => 'hero_label', 'label' => 'Ana Sayfa - Hero Üst Etiket', 'type' => 'text', 'value' => 'DENİZLİ TEKNİK', 'order' => 0],
            ['page' => 'home', 'key' => 'hero_baslik', 'label' => 'Ana Sayfa - Hero Başlık', 'type' => 'text', 'value' => 'Denizli Servis Hizmetleri', 'order' => 1],
            ['page' => 'home', 'key' => 'hero_alt_baslik', 'label' => 'Ana Sayfa - Hero Alt Başlık', 'type' => 'textarea', 'value' => 'Tüm marka beyaz eşyaların tamir bakım ve onarımını yapan servislerin listesini sizin için Paylaştık.', 'order' => 2],
            ['page' => 'home', 'key' => 'hero_gorsel', 'label' => 'Ana Sayfa - Hero Görsel', 'type' => 'image', 'value' => 'img/landing/header_bg.jpg', 'order' => 3],
            ['page' => 'home', 'key' => 'section_services_baslik', 'label' => 'Hizmetler Bölümü Başlık', 'type' => 'text', 'value' => 'Servis Hizmetlerimiz', 'order' => 10],
            ['page' => 'home', 'key' => 'section_services_metin', 'label' => 'Hizmetler Bölümü Metin', 'type' => 'textarea', 'value' => 'Beyaz eşya, kombi ve klima tamir ve bakım hizmeti sunuyoruz.', 'order' => 11],
            ['page' => 'home', 'key' => 'home_son_yazilar_baslik', 'label' => 'Ana Sayfa - Son Yazılar Başlığı', 'type' => 'text', 'value' => 'Son Yazılar', 'order' => 12],
            ['page' => 'home', 'key' => 'home_tum_yazilar_buton', 'label' => 'Ana Sayfa - Tüm Yazılar Butonu', 'type' => 'text', 'value' => 'Tüm Yazılar', 'order' => 13],
            ['page' => 'home', 'key' => 'section_cta_baslik', 'label' => 'CTA Bölümü Başlık', 'type' => 'text', 'value' => 'Hemen Arayın', 'order' => 20],
            ['page' => 'home', 'key' => 'section_cta_metin', 'label' => 'CTA Bölümü Metin', 'type' => 'textarea', 'value' => '7/24 teknik destek için bizi arayın.', 'order' => 21],
            ['page' => 'home', 'key' => 'section_cta_buton', 'label' => 'CTA Bölümü Buton Metni', 'type' => 'text', 'value' => 'İletişime Geçin', 'order' => 22],
            ['page' => 'home', 'key' => 'home_meta_title', 'label' => 'Ana Sayfa - SEO Meta Başlık', 'type' => 'text', 'value' => 'Denizli Teknik Servis - Beyaz Eşya, Kombi, Klima Servisi', 'order' => 30],
            ['page' => 'home', 'key' => 'home_meta_description', 'label' => 'Ana Sayfa - SEO Meta Açıklama', 'type' => 'textarea', 'value' => 'Denizli Teknik - Beyaz eşya, kombi ve klima servisi. Güvenilir ve hızlı hizmet.', 'order' => 31],
            ['page' => 'home', 'key' => 'home_meta_keywords', 'label' => 'Ana Sayfa - SEO Meta Anahtar Kelimeler', 'type' => 'textarea', 'value' => 'Denizli teknik servis, beyaz eşya servisi, kombi servisi, klima servisi', 'order' => 32],

            // Footer
            ['page' => 'footer', 'key' => 'footer_aciklama', 'label' => 'Footer Açıklama', 'type' => 'textarea', 'value' => 'Denizli Teknik - Beyaz eşya, kombi ve klima servisi.', 'order' => 1],
            ['page' => 'footer', 'key' => 'footer_tel', 'label' => 'Footer Telefon', 'type' => 'text', 'value' => '+90 258 000 00 00', 'order' => 2],
            ['page' => 'footer', 'key' => 'footer_email', 'label' => 'Footer E-posta', 'type' => 'text', 'value' => 'info@denizliteknik.com', 'order' => 3],
            ['page' => 'footer', 'key' => 'footer_adres', 'label' => 'Footer Adres', 'type' => 'textarea', 'value' => 'Denizli, Türkiye', 'order' => 4],
            ['page' => 'footer', 'key' => 'footer_copyright', 'label' => 'Footer Copyright', 'type' => 'text', 'value' => '© 2025 Denizli Teknik. Tüm hakları saklıdır.', 'order' => 5],

            // Blog liste sayfası
            ['page' => 'blog_list', 'key' => 'blog_baslik', 'label' => 'Blog Sayfası Başlık', 'type' => 'text', 'value' => 'Blog', 'order' => 1],
            ['page' => 'blog_list', 'key' => 'blog_alt_baslik', 'label' => 'Blog Sayfası Alt Başlık', 'type' => 'text', 'value' => 'Son Yazılar', 'order' => 2],
            ['page' => 'blog_list', 'key' => 'blog_read_more', 'label' => 'Devamını Oku Butonu', 'type' => 'text', 'value' => 'Devamını Oku', 'order' => 3],
            ['page' => 'blog_list', 'key' => 'blog_meta_title', 'label' => 'Blog Liste - SEO Meta Başlık', 'type' => 'text', 'value' => 'Blog - Denizli Teknik', 'order' => 4],
            ['page' => 'blog_list', 'key' => 'blog_meta_description', 'label' => 'Blog Liste - SEO Meta Açıklama', 'type' => 'textarea', 'value' => 'Denizli Teknik blog yazıları ve servis haberleri.', 'order' => 5],
            ['page' => 'blog_list', 'key' => 'blog_meta_keywords', 'label' => 'Blog Liste - SEO Meta Anahtar Kelimeler', 'type' => 'textarea', 'value' => 'Denizli teknik servis blog, beyaz eşya haberleri', 'order' => 6],
            ['page' => 'blog_list', 'key' => 'blog_sidebar_kategoriler', 'label' => 'Blog - Sidebar Kategoriler Başlığı', 'type' => 'text', 'value' => 'Kategoriler', 'order' => 7],
            ['page' => 'blog_list', 'key' => 'blog_sidebar_tumu', 'label' => 'Blog - Tümü Link Metni', 'type' => 'text', 'value' => 'Tümü', 'order' => 8],
            ['page' => 'blog_list', 'key' => 'blog_hic_yazi_yok', 'label' => 'Blog - Yazı Yok Mesajı', 'type' => 'text', 'value' => 'Henüz yazı bulunmuyor.', 'order' => 9],

            // Blog yazı sayfası
            ['page' => 'blog_post', 'key' => 'blog_share_text', 'label' => 'Paylaş Metni', 'type' => 'text', 'value' => 'Bu yazıyı paylaş', 'order' => 1],

            // Hakkımızda
            ['page' => 'about', 'key' => 'about_baslik', 'label' => 'Hakkımızda Başlık', 'type' => 'text', 'value' => 'Hakkımızda', 'order' => 1],
            ['page' => 'about', 'key' => 'about_icerik', 'label' => 'Hakkımızda İçerik', 'type' => 'textarea', 'value' => 'Denizli Teknik olarak beyaz eşya, kombi ve klima servisi hizmeti veriyoruz.', 'order' => 2],
            ['page' => 'about', 'key' => 'about_gorsel', 'label' => 'Hakkımızda Görsel', 'type' => 'image', 'value' => 'img/page-header/page-header-about-us.jpg', 'order' => 3],
            ['page' => 'about', 'key' => 'about_meta_title', 'label' => 'Hakkımızda - SEO Meta Başlık', 'type' => 'text', 'value' => 'Hakkımızda - Denizli Teknik', 'order' => 4],
            ['page' => 'about', 'key' => 'about_meta_description', 'label' => 'Hakkımızda - SEO Meta Açıklama', 'type' => 'textarea', 'value' => 'Denizli Teknik servis hakkında bilgi.', 'order' => 5],
            ['page' => 'about', 'key' => 'about_meta_keywords', 'label' => 'Hakkımızda - SEO Meta Anahtar Kelimeler', 'type' => 'textarea', 'value' => 'Denizli teknik servis, hakkımızda', 'order' => 6],

            // İletişim
            ['page' => 'contact', 'key' => 'contact_baslik', 'label' => 'İletişim Başlık', 'type' => 'text', 'value' => 'İletişim', 'order' => 1],
            ['page' => 'contact', 'key' => 'contact_alt_baslik', 'label' => 'İletişim Alt Başlık', 'type' => 'text', 'value' => 'Bize ulaşın', 'order' => 2],
            ['page' => 'contact', 'key' => 'contact_form_baslik', 'label' => 'İletişim Form Başlık', 'type' => 'text', 'value' => 'Mesaj Gönderin', 'order' => 3],
            ['page' => 'contact', 'key' => 'contact_iletisim_bilgileri_baslik', 'label' => 'İletişim - Bilgi Kutusu Başlığı', 'type' => 'text', 'value' => 'İletişim Bilgileri', 'order' => 4],
            ['page' => 'contact', 'key' => 'contact_meta_title', 'label' => 'İletişim - SEO Meta Başlık', 'type' => 'text', 'value' => 'İletişim - Denizli Teknik', 'order' => 5],
            ['page' => 'contact', 'key' => 'contact_meta_description', 'label' => 'İletişim - SEO Meta Açıklama', 'type' => 'textarea', 'value' => 'Denizli Teknik ile iletişime geçin.', 'order' => 6],
            ['page' => 'contact', 'key' => 'contact_meta_keywords', 'label' => 'İletişim - SEO Meta Anahtar Kelimeler', 'type' => 'textarea', 'value' => 'Denizli teknik servis iletişim, bize ulaşın', 'order' => 7],
        ];

        foreach ($contents as $item) {
            SiteContent::updateOrCreate(
                ['key' => $item['key']],
                $item
            );
        }
    }
}
