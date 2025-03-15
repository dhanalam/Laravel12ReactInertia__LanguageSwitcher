import { DropdownMenu, DropdownMenuContent, DropdownMenuTrigger } from '@/components/ui/dropdown-menu';
import { SidebarMenuButton, useSidebar } from '@/components/ui/sidebar';
import { useIsMobile } from '@/hooks/use-mobile';
import { getLocales, setTranslation } from '@/lib/translations';
import { SubNavItem } from '@/types';
import { Link } from '@inertiajs/react';
import { ChevronsUpDown } from 'lucide-react';

export default function LanguageSwitcher(props: SubNavItem) {

  const locales = getLocales();
  const { state } = useSidebar();
  const isMobile = useIsMobile();

  return (
      <DropdownMenu>
        <DropdownMenuTrigger asChild>
          <SidebarMenuButton size="lg" className="pl-3 text-sidebar-accent-foreground data-[state=open]:bg-sidebar-accent group">
          {
            props.icon ? (
              <props.icon className='pr-1' />
            ) : ''
          }
          <div className="grid flex-1 text-left text-sm leading-tight">
            <span className="truncate font-medium">{props.title}</span>
          </div>
            <ChevronsUpDown className="ml-auto size-4" />
          </SidebarMenuButton>
        </DropdownMenuTrigger>
        <DropdownMenuContent
          className="w-(--radix-dropdown-menu-trigger-width) min-w-56 rounded-lg"
          align="end"
          side={isMobile ? 'bottom' : state === 'collapsed' ? 'left' : 'bottom'}
        >
          <ul className="py-1">
            {locales.map((locale) => (
              <li key={locale.code}>
                <Link
                  href={`/language/${locale.code}`}
                  className="block px-4 py-2 text-neutral-900 dark:text-neutral-100 hover:bg-neutral-100 dark:hover:bg-neutral-800 hover:text-neutral-900 dark:hover:text-neutral-100"
                  onClick={() => setTranslation(locale.code)}
                >
                  {locale.name}
                </Link>
              </li>
            ))}
          </ul>
        </DropdownMenuContent>
      </DropdownMenu>
  );
}
