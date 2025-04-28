<script setup>
import { TabPanel, Tabs, TabList, Tab, TabPanels } from "primevue";
import About from "./Tabs/About.vue";
import CompanyJobs from "./Tabs/CompanyJobs.vue";
import { ref } from "vue";

const props = defineProps({
    company: Object,
});

const activeTabIndex = ref(0);
const tabs = [
    { title: "About", component: About, value: 0 },
    { title: "Jobs", component: CompanyJobs, value: 1 },
];
</script>

<template>
    <div>
        <Tabs v-model:value="activeTabIndex">
            <TabList class="flex gap-x-4 justify-between">
                <Tab v-for="tab in tabs" :key="tab.title" :value="tab.value">
                    {{ tab.title }}
                </Tab>
            </TabList>
            <TabPanels>
                <TabPanel
                    v-for="tab in tabs"
                    :key="tab.title"
                    :value="tab.value"
                >
                    <component :is="tab.component" :jobs="company.jobs" />
                </TabPanel>
            </TabPanels>
        </Tabs>
    </div>
</template>

<style scoped>
:deep(.p-tablist-tab-list) {
    background-color: #f1f1f1 !important;
    display: flex;
    justify-content: center;
}
:deep(.p-tab) {
    color: black !important;
}
:deep(.p-tab-active) {
    background-color: white !important;
}
</style>
