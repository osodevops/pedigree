<template>
    <div class="max-w-full w-full">
        <h2 class="text-black text-lg mb-2">Languages</h2>
        <base-card>
            <div class="h-full">
                <repository-languages :languages="languages" />
            </div>
        </base-card>
    </div>
</template>

<script>
import RepositoryLanguages from "@/Components/RepositoryLanguages";
import BaseCard from "@/Components/Base/Card";

export default {
    components: {
        RepositoryLanguages,
        BaseCard
    },
    props: {
        username: {
            type: String,
            required: true
        },
        repository: {
            type: String,
            required: true
        }
    },
    data() {
        return {
            languages: {}
        }
    },
    mounted() {
        axios
            .get(`/repos/${this.username}/${this.repository}/stats/languages`)
            .then(({ data }) => {
                this.languages = data.data;
            });
    }
}
</script>