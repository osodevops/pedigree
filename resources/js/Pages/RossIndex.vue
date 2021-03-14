<template>
    <app-layout>
        <section class="bg-gray-100 w-full border-b border-gray-200 pt-8 mb-8">
            <div class="flex flex-col sm:mx-6 px-6">
                <div class="md:mt-32 mt-12 md:w-4/5 self-center">
                    <h1 class="font-bold text-center md:text-6xl text-5xl leading-12">
                        ROSS Index: the fastest-growing open-source startups, every quarter
                    </h1>
                </div>
                <div class="mt-16 md:w-1/2 self-center px-6">
                    <p class="text-center md:text-2xl text-xl leading-12">
                        We select the top-20 open-source startups by their growth at Github quarterly. The transparent and measurable methodology allows to call it Runa Open Source Startup (ROSS) Index
                    </p>
                </div>
            </div>

            <div class="flex flex-col mt-14">
                <div class="mt-8 md:w-3/5 self-center px-6">
                    <p class="text-md leading-9">
                        We look for promising companies with a fast-growing army of fans, track them at Github, and decided to open-source our findings as an index.
                        ROSS index highlights top-20 open-source startups by the annualised growth rate (AGR) of Github stars at their repositories. While these stars are not a perfect metric for community evaluation, they allow us to understand which OSS products were on top of developers’ mind last quarter. Our index is transparent, measurable and fully focused on startups.
                    </p>
                </div>
            </div>
            
            <div class="relative bg-gray py-16 sm:py-24">
                <div class="lg:mx-auto lg:max-w-7xl lg:px-8 lg:grid lg:grid-cols-2 lg:gap-24 lg:items-start">
                    <div class="relative sm:py-16 lg:py-0">
                    <div aria-hidden="true" class="hidden sm:block lg:absolute lg:inset-y-0 lg:right-0 lg:w-screen">
                        <div class="absolute inset-y-0 right-1/2 w-full bg-gray-50 rounded-r-3xl lg:right-72"></div>
                        <svg class="absolute top-8 left-1/2 -ml-3 lg:-right-8 lg:left-auto lg:top-12" width="404" height="392" fill="none" viewBox="0 0 404 392">
                        <defs>
                            <pattern id="02f20b47-fd69-4224-a62a-4c9de5c763f7" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                            <rect x="0" y="0" width="4" height="4" class="text-gray-200" fill="currentColor" />
                            </pattern>
                        </defs>
                        <rect width="404" height="392" fill="url(#02f20b47-fd69-4224-a62a-4c9de5c763f7)" />
                        </svg>
                    </div>
                    <div class="relative mx-auto max-w-md px-4 sm:max-w-3xl sm:px-6 lg:px-0 lg:max-w-none lg:py-20">
                        <div class="relative pt-64 pb-10 rounded-2xl shadow-xl overflow-hidden">
                        <img class="absolute inset-0 h-full w-full object-cover" src="https://images.unsplash.com/photo-1542744173-05336fcc7ad4?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1591&q=80" alt="">
                        <div class="absolute inset-0 bg-gray-500" style="mix-blend-mode: multiply;"></div>
                        <div class="absolute inset-0 bg-gradient-to-t from-gray-600 via-gray-600 opacity-90"></div>
                        <div class="relative px-8">
                            <div class="relative text-lg font-medium text-white md:flex-grow">
                                <p class="relative">
                                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Qui quas autem repellat iure blanditiis culpa ullam asperiores, veniam atque aut fuga se
                                </p>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>

                    <div class="relative mx-auto max-w-md px-4 sm:max-w-3xl sm:px-6 lg:px-0">
                    <!-- Content area -->
                    <div class="pt-12 sm:pt-16 lg:pt-20">
                        <h2 class="text-3xl text-gray-900 font-extrabold tracking-tight sm:text-4xl">
                        Our Methodology
                        </h2>
                        <div class="mt-6 text-gray-500 space-y-6">
                    
                        <p class="text-base leading-7">
                            ROSS index uses only public data from Github, Crunchbase, mass media, and other sources. We strive to show cities and countries connected with the origin of companies, not just formal HQ locations. We are purely focused on companies using the English language in descriptions at their repos and corporate websites, so some local startups (e.g. Chinese) could be missed in the index. We define a “startup” as:                        
                        </p>
                        </div>
                    </div>

                    <!-- Stats section -->
                    <div class="mt-10">
                        <dl class="grid grid-cols-2 gap-x-4 gap-y-8">
                        <div class="border-t-2 border-gray-100 pt-6">
                            <dt class="text-base font-medium text-gray-500">Minimum GitHub stars</dt>
                            <dd class="text-lg font-extrabold tracking-tight text-gray-900">1000</dd>
                        </div>

                        <div class="border-t-2 border-gray-100 pt-6">
                            <dt class="text-base font-medium text-gray-500">Founded</dt>
                            <dd class="text-lg font-extrabold tracking-tight text-gray-900">Less than 10 years ago</dd>
                        </div>

                        <div class="border-t-2 border-gray-100 pt-6">
                            <dt class="text-base font-medium text-gray-500">Money raised</dt>
                            <dd class="text-lg font-extrabold tracking-tight text-gray-900">Less than 100m</dd>
                        </div>

                        <div class="border-t-2 border-gray-100 pt-6">
                            <dt class="text-base font-medium text-gray-500">Company status</dt>
                            <dd class="text-lg font-extrabold tracking-tight text-gray-900">Not acquired or public</dd>
                        </div>
                        </dl>
                        <div class="mt-10">
                        <a href="https://osodevops.io/" target="_blank" class="text-base font-medium text-gray-600"> Learn more about OSO DevOps can help you <span aria-hidden="true">&rarr;</span> </a>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="mx-auto max-w-5xl min-w-sm overflow-x-auto pt-8 mb-8">
            <CompaniesTable :companies="companies"></CompaniesTable>
        </section>

    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import CompaniesTable from "@/Components/RossIndex/CompaniesTable";

export default {
    components: {
        AppLayout,
        CompaniesTable,
    },
    props: [
        'companies'
    ]
};
</script>
