import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/react';

const breadcrumbs: BreadcrumbItem[] = [
  {
    title: 'Home',
    href: '/dashboard',
  },
  {
    title: 'Languages',
    href: '/languages/list',
  },
];

export default function List() {
  return (
    <AppLayout breadcrumbs={breadcrumbs}>
      <Head title="Blog List" />
      <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
        <h1>Language Management</h1>
      </div>
    </AppLayout>
  );
}
