<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Settings;

use App\Helpers;
use App\Models\Settings;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;
    use LivewireAlert;

    public $company_name;

    public $site_title;

    public $logoFile;

    public $iconFile;

    public $breadCrumb;

    public $breadCrumbImg;

    public $favicon;

    public $siteImage;

    public $primary_color;

    public $secondary_color;

    public $company_email_address;

    public $company_phone;

    public $company_address;

    public $social_facebook;

    public $social_twitter;

    public $social_instagram;

    public $social_linkedin;

    public $social_whatsapp;

    public $head_tags;

    public $body_tags;

    public $seo_meta_title;

    public $seo_meta_description;

    public $footer_copyright_text;
    public $site_maintenance_message;

    public function mount()
    {
        $this->company_name = Helpers::settings('company_name');
        $this->site_title = Helpers::settings('site_title');
        $this->company_email_address = Helpers::settings('company_email_address');
        $this->company_phone = Helpers::settings('company_phone');
        $this->company_address = Helpers::settings('company_address');
        $this->siteImage = Helpers::settings('site_logo');
        $this->favicon = Helpers::settings('site_favicon');
        $this->breadCrumb = Helpers::settings('site_breadCrumb_img');
        $this->social_facebook = Helpers::settings('social_facebook');
        $this->social_twitter = Helpers::settings('social_twitter');
        $this->social_instagram = Helpers::settings('social_instagram');
        $this->social_linkedin = Helpers::settings('social_linkedin');
        $this->social_whatsapp = Helpers::settings('social_whatsapp');
        $this->head_tags = Helpers::settings('head_tags');
        $this->body_tags = Helpers::settings('body_tags');
        $this->seo_meta_title = Helpers::settings('seo_meta_title');
        $this->seo_meta_description = Helpers::settings('seo_meta_description');
        $this->footer_copyright_text = Helpers::settings('footer_copyright_text');
        $this->primary_color = Helpers::settings('primary_color');
        $this->secondary_color = Helpers::settings('secondary_color');
        $this->site_maintenance_message = Helpers::settings('site_maintenance_message');
    }

    public function save()
    {
        $settings = [
            'company_name'             => $this->company_name,
            'site_title'               => $this->site_title,
            'company_email_address'    => $this->company_email_address,
            'company_phone'            => $this->company_phone,
            'company_address'          => $this->company_address,
            'social_facebook'          => $this->social_facebook,
            'social_twitter'           => $this->social_twitter,
            'social_instagram'         => $this->social_instagram,
            'social_linkedin'          => $this->social_linkedin,
            'social_whatsapp'          => $this->social_whatsapp,
            'head_tags'                => $this->head_tags,
            'body_tags'                => $this->body_tags,
            'seo_meta_title'           => $this->seo_meta_title,
            'seo_meta_description'     => $this->seo_meta_description,
            'footer_copyright_text'    => $this->footer_copyright_text,
            'primary_color'            => $this->primary_color,
            'secondary_color'          => $this->secondary_color,
            'site_maintenance_message' => $this->site_maintenance_message,
        ];

        foreach ($settings as $key => $value) {
            Settings::set($key, $value);
        }

        $this->alert('success', __('Settings updated successfully!'));
    }

    public function uploadFavicon()
    {
        $favicon = $this->upload($this->iconFile, $this->favicon, 'iconFile');

        if ($favicon) {
            Settings::set('site_favicon', $favicon);
            $this->alert('success', __('Favicon updated successfully!'));
            $this->iconFile = '';
            $this->favicon = $favicon;
        } else {
            $this->alert('error', __('Unable to upload your image'));
        }
    }

    public function uploadbreadCrumb()
    {
        $breadCrumb = $this->upload($this->breadCrumbImg, $this->breadCrumbImg, 'breadCrumbImg');

        if ($breadCrumb) {
            Settings::set('site_breadCrumb_img', $breadCrumb);
            $this->alert('success', __('breadcrumb Image updated successfully!'));
            $this->breadCrumbImg = '';
            $this->breadCrumbImg = $breadCrumb;
        } else {
            $this->alert('error', __('Unable to upload your image'));
        }
    }

    public function uploadLogo()
    {
        $logo = $this->upload($this->logoFile, $this->siteImage, 'logoFile');

        if ($logo) {
            Settings::set('site_logo', $logo);
            $this->alert('success', __('Logo updated successfully!'));
            $this->logoFile = '';
            $this->siteImage = $logo;
        } else {
            $this->alert('error', __('Unable to upload your image'));
        }
    }

    public function render(): View|Factory
    {
        return view('livewire.admin.settings.index');
    }

    private function upload($filename, $name, $validateName)
    {
        $this->validate([
            $validateName => 'required|mimes:jpeg,png,jpg,gif,svg|max:1048',
        ]);

        if ($name !== null) {
            Storage::delete('logo/'.$name);
        }

        return Storage::disk('local_files')->put('logo', $filename, 'public');
    }
}
