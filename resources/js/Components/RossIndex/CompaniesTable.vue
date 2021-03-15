<template>
    <table class="w-full shadow-lg bg-white">
        <thead>
            <tr class="font-semibold text-xs bg-gray-100 border border-gray-200">
                <td>Company</td>
                <td>Country</td>
                <td>City</td>
                <td>Founded</td>
                <td>Repo</td>
                <td>Stars</td>
                <td>Forks</td>
                <td>Stars AGR</td>
                <td class="no-border">Forks AGR</td>
            </tr>
        </thead>
        <tbody class="border-b border-gray-200 text-sm">
            <tr class="border-l border-gray-200" v-for="row in companies" v-bind:key="row.company.name">
                <td>
                    <a target="_blank" class="text-blue-500 underline" :href="row.company.url">{{ row.company.name }}</a>
                </td>
                <td>{{ row.company.country }}</td>
                <td>{{ row.company.city }}</td>
                <td>{{ row.company.founded }}</td>
                <td>
                    <a target="_blank" class="text-blue-500 underline" :href="`https://github.com/${row.repo.user}/${row.repo.repository}`">
                        {{ row.repo.user }}/{{row.repo.repository}}
                    </a>
                </td>
                <td class="text-right">{{ format(row.stars) }}</td>
                <td class="text-right">{{ format(row.forks) }}</td>
                <td class="text-right">{{ format(row.stars_agr) }}%</td>
                <td class="text-right">{{ format(row.forks_agr) }}%</td>
            </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    props: [
        'companies',
    ],
    methods: {
        format(number) {
            return new Intl.NumberFormat('en-GB').format(number);
        }
    }
}
</script>

<style scoped>
tbody tr:nth-child(even) {
    @apply bg-gray-100;
}
td {
    @apply px-2 py-2 border-r border-gray-200;
}
td.no-border {
    @apply border-none;
}
</style>
