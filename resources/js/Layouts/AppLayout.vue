<template>
    <div class="min-h-screen bg-white">
        <nav class="bg-black border-b">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="flex-shrink-0 flex items-center">
                            <inertia-link :href="route('dashboard')" class="flex items-center">
                                <jet-application-mark class="block h-8 w-auto"/>
                                <span class="ml-4 text-white uppercase tracking-widest text-xl font-bold">Pedigree</span>
                            </inertia-link>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="">
            <slot></slot>
        </main>
    </div>
</template>

<script>
import JetApplicationMark from "@/Components/Logos/Shield";

export default {
    components: {
        JetApplicationMark,
    },

    data() {
        return {
            showingNavigationDropdown: false
        };
    },

    methods: {
        switchToTeam(team) {
            this.$inertia.put(
                route("current-team.update"),
                {
                    team_id: team.id
                },
                {
                    preserveState: false
                }
            );
        },

        logout() {
            axios.post(route("logout").url()).then(response => {
                window.location = "/";
            });
        }
    }
};
</script>
