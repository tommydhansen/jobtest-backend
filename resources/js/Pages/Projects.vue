<script setup lang="ts">
import AppLayout from "@/Layouts/AppLayout.vue";
import Welcome from "@/Components/Welcome.vue";
import {
    DataTable,
    DefaultPaginator,
    LaravelSimplePaginator
} from "@sidewalk/vue3-datatable";
import type { ExposedTableState } from "@sidewalk/vue3-datatable";
import { onMounted, ref } from "vue";
import { router } from "@inertiajs/vue3";
import { EyeIcon } from "lucide-vue-next";

export interface Project {
    created_at: string;
    description: string;
    id: number;
    owner: number;
    title: string;
    updated_at: string;
}

export interface PaginatedProjects {
    current_page: number;
    data: Project[];
    // Add other fields like total, per_page, etc. if needed
}

const tableState = ref<ExposedTableState>();
const props = defineProps<{
    projects: PaginatedProjects;
}>();

const columns = [
    { key: 'id', label: 'ID' },
    { key: 'title', label: 'Title' },
    { key: 'description', label: 'Description' },
    { key: 'owner', label: 'Owner' },
    { key: 'created_at', label: 'Created At' },
];

onMounted(() => {
    if (props.projects?.current_page && tableState.value) {
        tableState.value.DataTable.currentPage = props.projects.current_page-1;
    }

});

const data = ref(props.projects);

const fetchData = async (api: string | URL): Promise<any> => {
    const url = new URL(api);
    router.visit(url);
};
</script>

<template>
    <AppLayout title="Projects">
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Projects
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                    <DataTable
                        :columns="columns"
                        :actions="[
                            {
                                icon: EyeIcon,
                                title: 'Se',
                                execute(row) {
                                    router.visit(
                                        route('projects.inspect', [row])
                                    );
                                },
                            },
                        ]"
                        :pagination="props?.projects?.data ? {
                            async getNextRows() {
                                if(!data)
                                    return [];

                                const nextUrl: string | undefined = data.next_page_url;
                                await fetchData(nextUrl);
                                return [];
                            },
                            async getPrevRows() {
                                const prevUrl: string | undefined = data?.prev_page_url;
                                await fetchData(prevUrl);
                                return [];
                            },
                            async getCurrentRows() {
                                return data.data;
                            },
                            async refresh(pageSize) {
                                return this.getCurrentRows(pageSize, 0);
                            },
                            hasNextPage() {
                                return data.next_page_url !== null;
                            },
                            hasPrevPage() {
                                return data.prev_page_url !== null;
                            },
                            onSearch(searched, typing) {
                                if (!typing) return false;

                                const url = new URL(input);
                                url.searchParams.set('search', searched);
                                return fetchData(url).then((res) => ({
                                    data: res.data,
                                    total: res.total ?? res.data.length,
                                }));
                            },
                            totalElements() {
                                return data?.total ?? 0;
                            },
                        } : DefaultPaginator(props.projects.data)"
                        :page-sizes="[50]"
                        :show-search-bar="false"
                        ref="tableState"
                    />

                    INDSÆT PROJEKT INDEX
                </div>
            </div>
        </div>
    </AppLayout>
</template>
