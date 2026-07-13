<aside class="fixed inset-y-0 left-0 w-64 bg-zinc-900 border-r border-zinc-800">

    <div class="p-6">

        <h1 class="text-3xl font-bold text-blue-500">
            CloudPi
        </h1>

        <p class="mt-1 text-sm text-zinc-400">
            Developer Hosting Platform
        </p>

    </div>

    <nav class="mt-8 px-3 space-y-1">

        <x-cloudpi.nav-item
            :href="route('dashboard')"
            :active="request()->routeIs('dashboard')"
        >
            Dashboard
        </x-cloudpi.nav-item>

        <x-cloudpi.nav-item
            href="#"
            :active="false"
        >
            Websites
        </x-cloudpi.nav-item>
        
        <x-cloudpi.nav-item
            href="#"
            :active="false"
        >
            Databases
        </x-cloudpi.nav-item>
        
        <x-cloudpi.nav-item
            href="#"
            :active="false"
        >
            Docker
        </x-cloudpi.nav-item>
        
        <x-cloudpi.nav-item
            href="#"
            :active="false"
        >
            Files
        </x-cloudpi.nav-item>

        <x-cloudpi.nav-item
            href="#"
            :active="false"
        >
            Cron Jobs
        </x-cloudpi.nav-item>
        
        <x-cloudpi.nav-item
            href="#"
            :active="false"
        >
            Backups
        </x-cloudpi.nav-item>
        
        <x-cloudpi.nav-item
            href="#"
            :active="false"
        >
            Monitoring
        </x-cloudpi.nav-item>
        
        <x-cloudpi.nav-item
            href="#"
            :active="false"
        >
            Settings
        </x-cloudpi.nav-item>

    </nav>

</aside>