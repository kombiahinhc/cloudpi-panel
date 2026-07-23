<div class="space-y-6">

    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold">Websites</h1>
            <p class="text-sm text-gray-500">
                Manage your hosted websites.
            </p>
        </div>

        <button
            class="rounded-lg bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700"
        >
            + New Website
        </button>
    </div>

    <div class="overflow-hidden rounded-lg border bg-white">
        <table class="min-w-full divide-y">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left">Domain</th>
                    <th class="px-4 py-3 text-left">PHP</th>
                    <th class="px-4 py-3 text-left">SSL</th>
                    <th class="px-4 py-3 text-left">Status</th>
                    <th class="px-4 py-3 text-left">Root</th>
                </tr>
            </thead>

            <tbody class="divide-y">
                @forelse($websites as $website)
                    <tr>
                        <td class="px-4 py-3 font-medium">
                            {{ $website['domain'] }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $website['phpVersion'] }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $website['sslEnabled'] ? '✅' : '❌' }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $website['enabled'] ? 'Enabled' : 'Disabled' }}
                        </td>

                        <td class="px-4 py-3 text-sm text-gray-500">
                            {{ $website['root'] }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                            No websites found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>