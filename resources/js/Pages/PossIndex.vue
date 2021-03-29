<template>
    <app-layout>
        <section class="w-full bg-gray-100 py-8 mb-8 border-b border-gray-200">
            <base-container>
                <div class="mt-8 sm:mt-12 lg:mt-16">
                    <h1 class="font-bold text-center text-5xl lg:text-6xl leading-12">
                        POS Index: the fastest-growing open-source repositories, every quarter.
                    </h1>
                </div>
                <div class="mt-8 sm:mt-12 self-center">
                    <p class="text-center sm:text-xl lg:text-2xl leading-12">
                       We select the top-20 open-source repositories by their developer growth at GitHub monthly. Our transparent and measurable methodology is known as the Pedigree Open Source (POS) Index.
                    </p>
                </div>
            </base-container>
        </section>
        <main>
            <base-container>
                <div class="mt-8 self-center px-6">
                    <p class="text-md leading-9">
                       Pedigree is an open source project itself, built by developers for developers who leverage the power of open source communities. Our algorithms trawl GitHub hourly for promising projects with a fast-growing army of fans, to help every developer keep upto date with the latest emerging technologies, our findings are published as an index monthly.
                    </p>
                    <p class="text-md leading-9 mt-4">
                       Pedigree picks the top 20 open source projects by the annualised growth rate (AGR) made up from GitHub commits, stars and contributors. Issue resolution is a track metric for community adoption, this allows us to understand which projects are actively being improved every month. Our index is transparent, measurable and fully focused on public GitHub repositories.
                    </p>
                </div>
            </base-container>
        </main>

        <base-container>
            <h2 class="text-gray-900 font-extrabold tracking-tight text-lg sm:text-2xl pt-8 mb-4">The fastest-growing open-source repositories (March 2021)</h2>
        </base-container>
        <section class="mx-4 sm:ml-8 lg:mx-auto max-w-5xl border-gray-200 min-w-sm overflow-x-auto">
            <CompaniesTable :companies="companies"></CompaniesTable>
        </section>

        <base-container>
            <CompaniesChart :companies="companies"></CompaniesChart>
        </base-container>

    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import CompaniesTable from "@/Components/RossIndex/CompaniesTable";
import CompaniesChart from "@/Components/RossIndex/CompaniesChart";
import BaseContainer from "@/Components/Base/Container";

export default {
    components: {
        AppLayout,
        CompaniesTable,
        CompaniesChart,
        BaseContainer,
    },
    props: [
        'companies'
    ]
};
</script>
