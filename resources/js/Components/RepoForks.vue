<template>
    <section class="w-full mt-3">
        <section class="w-full flex flex-wrap mb-4">
            <btn-group classes="w-full sm:w-auto">
                <button type="button" :class="{'active': status === ''}" @click="setStatus('')">All</button>
                <button type="button" :class="{'active': status === 'ahead'}" @click="setStatus('ahead')">Ahead</button>
                <button type="button" :class="{'active': status === 'diverged'}" @click="setStatus('diverged')">Diverged</button>
                <button type="button" :class="{'active': status === 'behind'}" @click="setStatus('behind')">Behind</button>
                <button type="button" :class="{'active': status === 'identical'}" @click="setStatus('identical')">Identical</button>
            </btn-group>
            <jet-input
                class="ml-auto hidden sm:block"
                placeholder="Search forks..."
                v-model="searchText"
            ></jet-input>
        </section>
        <div>
            <div class="bg-gray-100 border border-gray-200 text-gray-700 rounded-tl-lg rounded-tr-lg">
                <div class="px-4 py-2 text-sm font-semibold">Forks</div>
            </div>
            <div
                v-for="(fork, index) in filteredForks(searchText, status)"
                :key="fork.id"
                class="w-full row"
            >
                <div class="flex flex-wrap p-4 border-l border-r border-b border-gray-200">
                    <div class="w-full flex flex-wrap justify-between items-center">
                        <a :href="`https://github.com/${fork.owner.id}/${fork.name}`" target="_blank" class="flex-1 flex">
                            <div class="mr-4" style="width: 48px; height:48px;">
                                <img :src="fork.owner.avatar_url" />
                            </div>

                            <div class="w-auto">
                                <span class="capitalize text-xl font-semibold">
                                    {{ fork.owner.id }}
                                </span>

                                <div class="flex text-black flex-col sm:flex-row text-gray-600">
                                    <div class="flex items-center mr-4 mb-1 sm:mb-0">
                                        <Icon icon="code-branch" size="xs" />
                                        <span class="text-sm ml-1">{{fork.default_branch}}</span>
                                    </div>
                                    <div class="flex items-center mr-4 mb-1 sm:mb-0">
                                        <Icon icon="star" size="xs" />
                                        <span class="text-sm ml-1">{{numberFormat(fork.watchers_count)}} stars</span>
                                    </div>
                                    <div class="flex items-center mb-1 sm:mb-0" v-if="fork.license">
                                        <Icon icon="balance-scale" size="xs" />
                                        <span class="text-sm ml-1">{{ fork.license }}</span>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <div class="mx-2">
                            <span v-if="fork.difference" class="rounded text-xs px-2 py-1 flex items-center" :class="{
                                'bg-red-100 text-red-600': fork.difference.status === 'error',
                                'bg-orange-100 text-orange-600': fork.difference.status === 'behind',
                                'bg-blue-100 text-blue-600': fork.difference.status === 'identical',
                                'bg-green-100 text-green-600': fork.difference.status === 'ahead',
                                'bg-indigo-100 text-indigo-600': fork.difference.status === 'diverged',
                                'bg-gray-100 text-gray-400': fork.difference.status === 'unknown',
                            }">
                                <Icon icon="circle" size="xs" class="mr-1" /><span>{{ fork.difference.status }}</span>
                            </span>
                            <span v-else class="rounded bg-gray-100 text-gray-400 text-xs px-2 py-1 flex items-center">
                                <Icon icon="circle" size="xs" class="mr-1" /><span>unknown</span>
                            </span>
                        </div>

                        <div class="hidden sm:block mx-2">
                            <Diff
                                :aheadBy="fork.difference ? (fork.difference.ahead_by || 0) : 0"
                                :behindBy="fork.difference ? (fork.difference.behind_by || 0) : 0"
                                :max="forkMaxScale"
                            />
                        </div>

                        <div>
                            <jet-button type="button" @click.native="updateForkShowState(index)">
                                {{ fork.showMore ? 'Less info' : 'More info' }}
                            </jet-button>
                        </div>
                    </div>
                    <div v-if="fork.showMore === true" class="max-w-full pt-4">
                        <repo-detail-view :repository="fork" />
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import { mapState, mapMutations, mapGetters } from "vuex";
import Icon from "@/Components/Base/Icon";
import JetInput from "@/Jetstream/Input";
import JetButton from "@/Jetstream/Button";
import Diff from "@/Components/Diff";
import RepoDetailView from "@/Components/RepoDetailView";
import BtnGroup from "@/Components/Base/ButtonGroup";

export default {
    components: {
        Icon,
        JetInput,
        JetButton,
        Diff,
        RepoDetailView,
        BtnGroup
    },
    data() {
        return {
            searchText: "",
            status: ""
        };
    },
    computed: {
        ...mapGetters("searchRepos", ["filteredForks", "forkMaxScale"]),
    },
    methods: {
        ...mapMutations("searchRepos", ["updateForkShowState"]),
        numberFormat(number) {
            return window.numberFormat(number);
        },
        setStatus(status) {
            this.status = status;
        }
    }
};
</script>

<style scoped>
.row:last-child {
    border-radius: 0px 0px .5rem .5rem;
}
</style>
