<section>
    <div class="container text-gray-900 dark:text-white">
        @forelse ($registered_robots as $category)
            <h2 class="font-semibold mt-4">{{ $category['category_name'] }}</h2>
            @if(empty($category['robots']))
                <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">No participations found for this category.</p>
            @else
                <table class="w-full mt-2 border-collapse border border-gray-300">
                    <thead>
                        <tr>
                            <th class="border border-gray-300 px-4 py-2 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">Robot Name</th>
                            <th class="border border-gray-300 px-4 py-2 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">Robot Owner</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($category['robots'] as $registered_robot)
                            <tr>
                                <td class="border border-gray-300 px-4 py-2 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">{{ $registered_robot['robot_name'] }}</td>
                                <td class="border border-gray-300 px-4 py-2 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">{{ $registered_robot['robot_owner'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        @empty
            <p>No categories found for this year.</p>
        @endforelse
    </div>
</section>
