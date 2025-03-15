type TranslationType<T> = { [key: string]: string | TranslationType<T> };
type Locales = Array<{ code: string, name: string }>;
declare global {
  interface Window {
    Laravel: {
      translations: TranslationType<string | TranslationType<string>>,
      locales: Locales,
    };
  }
}

export const getLocales = (): Locales => {
  return window.Laravel.locales;
};

export const setTranslation = (locale: string) => {
  localStorage.setItem('locale', locale);
  console.log('set locale', locale);
};

export const trans = (key: string, replacement: { [key: string]: string } = {}): string => {

  const locale = localStorage.getItem('locale') || 'en';
  console.log('get locale', locale);
  const translations = window.Laravel.translations as { [key: string]: { [key: string]: string } };
  let translation = translations![locale][key] || key;

  if (Object.keys(replacement).length > 0) {
    Object.keys(replacement).forEach(element => {
      translation = translation.replace(`:${element}`, replacement[element]);
    });
  }
  return translation;
}


export const __ = trans;

export default trans;
