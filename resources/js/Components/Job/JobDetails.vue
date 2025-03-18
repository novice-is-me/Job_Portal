<script setup>
import { TabPanel, Tabs, TabList, Tab, TabPanels } from "primevue";
import Description from "./Tabs/Description.vue";
import CompanyDetails from "./Tabs/CompanyDetails.vue";
import Reviews from "./Tabs/Reviews.vue";
import { ref } from "vue";

const activeTabIndex = ref(0);

const tabs = [
    { title: "Description", component: Description, value: 0 },
    { title: "Company", component: CompanyDetails, value: 1 },
    { title: "Reviews", component: Reviews, value: 2 },
];
</script>

<template>
    <div class="rounded-lg border border-gray-200">
        <Tabs v-model:value="activeTabIndex">
            <TabList class="flex gap-x-4 justify-between">
                <Tab v-for="tab in tabs" :key="tab.title" :value="tab.value">{{
                    tab.title
                }}</Tab>
            </TabList>
            <TabPanels>
                <TabPanel
                    v-for="tab in tabs"
                    :key="tab.title"
                    :value="tab.value"
                >
                    <component :is="tab.component" />
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
