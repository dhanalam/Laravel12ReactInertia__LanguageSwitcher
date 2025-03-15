<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;

class InertiaTranslation extends Component
{

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $translations = $this->getAllFileTranslations();

        return view('components.inertia-translation', compact('translations'));
    }

    public function getAllFileTranslations(): array
    {
        return Cache::rememberForever('translations_all', function () {
            $translations = [];
            $locales = config('app.locales');
            foreach ($locales as $locale) {
                $translations[$locale] = $this->currentLocaleFileTranslations($locale);
            }
            return $translations;
        });
    }

    /**
     * Single Translation Method
     *
     * @return array
     */
    private function currentLocaleFileTranslations(string $locale): array
    {
        if (!$this->doesLocaleFileExists($locale)) {
            $locale = (string) app()->getFallbackLocale();
        }

        return Cache::rememberForever("translations_{$locale}", function () use ($locale): array {
            $jsonTranslations = $this->getJsonTranslationsArray($locale);
            $phpTranslations = $this->getPhpTranslationsArray($locale);

            return [
                ...$phpTranslations,
                ...$jsonTranslations,
            ];
        });
    }

    /**
     * Get Php Translations Array
     * @param mixed $locale
     * @return array
     */
    private function getPhpTranslationsArray($locale)
    {
        $phpTranslations = [];
        $localeFolderPath = $this->getLocaleFolderPath($locale);

        if (File::exists( $localeFolderPath )) {
            $files = File::allFiles($localeFolderPath);

            foreach ($files as $file) {
                $filename = $file->getFilename();
                $extension = $file->getExtension();
                $filenameWithoutExtension = pathinfo($filename, PATHINFO_FILENAME);

                if ($extension === 'php') {
                    $phpTranslations[$filenameWithoutExtension] = File::getRequire($file->getPathname());
                }
            }
        }

        return $phpTranslations;
    }

    /**
     * Get Json Translation Array
     *
     * @param mixed $locale
     * @return array
     */
    private function getJsonTranslationsArray($locale): array
    {
        if (File::exists(lang_path("{$locale}.json"))) {
            return json_decode(File::get(lang_path("{$locale}.json")), true);
        }

        return [];
    }

    /**
     * check if the locale file exists
     *
     * @param string $locale
     * @return bool
     */
    private function doesLocaleFileExists(string $locale)
    {
        return File::exists(lang_path("{$locale}.json")) || File::isDirectory($this->getLocaleFolderPath($locale));
    }

    /**
     * Get the locale folder path
     *
     * @param string $locale
     * @return string
     */
    private function getLocaleFolderPath(string $locale)
    {
        return lang_path($locale);
    }
}
