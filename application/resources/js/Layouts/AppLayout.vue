<template>
    <div class="min-h-screen bg-white">
        <nav class="bg-black border-b">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="flex-shrink-0 flex items-center">
                            <inertia-link :href="route('dashboard')" class="flex items-center">
                                <jet-application-mark
                                    class="block h-8 w-auto"
                                />
                                <span class="ml-4 text-white uppercase tracking-widest text-xl font-bold">Pedigree</span>
                            </inertia-link>
                        </div>

                        <!-- Navigation Links -->
                        <!-- <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex text-white">
                            <jet-nav-link :href="route('dashboard')" :active="route().current('dashboard')">
                                Dashboard
                            </jet-nav-link>
                        </div> -->
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="">
            <slot></slot>
        </main>

        <!-- Modal Portal -->
        <portal-target name="modal" multiple> </portal-target>
    </div>
</template>

<script>
import JetApplicationMark from "@/Jetstream/ApplicationMark";
import JetDropdown from "@/Jetstream/Dropdown";
import JetDropdownLink from "@/Jetstream/DropdownLink";
import JetNavLink from "@/Jetstream/NavLink";
import JetResponsiveNavLink from "@/Jetstream/ResponsiveNavLink";

export default {
    components: {
        JetApplicationMark,
        JetDropdown,
        JetDropdownLink,
        JetNavLink,
        JetResponsiveNavLink
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
