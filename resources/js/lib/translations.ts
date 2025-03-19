type TranslationType<T> = { [key: string]: string | TranslationType<T> };
type Locales = Array<{ code: string, name: string }>;

declare global {
  interface Window {
    Laravel: {
      translations: TranslationType<string>,
      locales: Locales,
    };
  }
}

export const getLocales = (): Locales => {
  return window.Laravel.locales;
};

export const setTranslation = (locale: string) => {
  localStorage.setItem('locale', locale);
};

export const trans = (key: string, replacement: { [key: string]: string } = {}): string => {
  const locale = localStorage.getItem('locale') || 'en';
  const translations = window.Laravel.translations[locale] as TranslationType<string>;

  let translation = translations[key] as string || key;

  for (const [element, value] of Object.entries(replacement)) {
    translation = translation.replace(`:${element}`, value);
  }

  return translation;
}

export const __ = trans;

export default trans;
