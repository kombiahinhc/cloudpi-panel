<div class="p-8">

    <h1 class="mb-6 text-3xl font-bold">
        Docker Containers
    </h1>

    <div class="overflow-hidden rounded-xl border border-zinc-800 bg-zinc-900">

        <table class="min-w-full">

            <thead>
                <tr>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>State</th>
                    <th>Ports</th>
                    <th>Running For</th>
                </tr>
            </thead>

            <tbody>

                @foreach ($containers as $container)

                    <tr>
                        <td>{{ $container->name }}</td>
                        <td>{{ $container->image }}</td>
                        <td>{{ $container->status }}</td>
                        <td>{{ $container->state }}</td>
                        <td>{{ $container->ports }}</td>
                        <td>{{ $container->created }}</td>
                    </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>