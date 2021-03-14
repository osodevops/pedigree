<template>
    <app-layout>
        <section class="bg-gray-100 w-full border-b border-gray-200 pt-8 mb-8">
            <div class="flex flex-col sm:mx-6 px-6">
                <div class="sm:mt-32 mt-12 sm:w-4/5 self-center">
                    <h1 class="font-bold text-center sm:text-6xl text-5xl leading-12"> 
                        ROSS Index: the fastest-growing open-source startups, every quarter
                    </h1>
                </div>
                <div class="mt-16 sm:w-1/2 self-center px-6">
                    <p class="text-center sm:text-2xl text-xl leading-12">
                        We select the top-20 open-source startups by their growth at Github quarterly. The transparent and measurable methodology allows to call it Runa Open Source Startup (ROSS) Index
                    </p>
                </div>
            </div>

            <div class="flex flex-col mt-14">
                <div class="mt-8 sm:w-3/5 self-center px-6">
                    <p class="text-md leading-9">
                        Runa actively invests in OSS startups (like Nginx and MariaDB) and considers an active developer community to be instrumental for open-source businesses. We look for promising companies with a fast-growing army of fans, track them at Github, and decided to open-source our findings as an index.
                        ROSS index highlights top-20 open-source startups by the annualised growth rate (AGR) of Github stars at their repositories. While these stars are not a perfect metric for community evaluation, they allow us to understand which OSS products were on top of developers’ mind last quarter. Our index is transparent, measurable and fully focused on startups.
                    </p>
                </div>
            </div>
        </section>

    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";

export default {
    components: {
        AppLayout,
    },
};
</script>
