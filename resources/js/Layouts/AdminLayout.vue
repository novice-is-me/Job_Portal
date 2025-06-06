<script setup>
import { ref } from "vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import { Link } from "@inertiajs/vue3";
import { Avatar, ConfirmDialog } from "primevue";

const showingNavigationDropdown = ref(false);

const tabs = [
    {
        name: "Company",
        href: "/dashboard/recruiter/", // matches route('/')
        icon: "fa-solid fa-building",
    },
    {
        name: "Jobs",
        href: "/dashboard/recruiter/jobs",
        icon: "fa-solid fa-briefcase",
    },
    {
        name: "Applicants",
        href: "/dashboard/recruiter/candidates",
        icon: "fa-solid fa-users",
    },
    {
        name: "Analytics",
        href: "/dashboard/recruiter/analytics",
        icon: "fa-solid fa-chart-line",
    },
];
</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-100">
            <nav
                class="fixed top-0 left-0 w-full z-50 border-b border-gray-100 bg-white"
            >
                <!-- Primary Navigation Menu -->
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="flex h-16 justify-between items-center">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="flex shrink-0 items-center">
                                <Link
                                    :href="route('dashboard')"
                                    class="flex items-center justify-center gap-x-2"
                                >
                                    <i
                                        class="pi pi-briefcase text-header"
                                        style="font-size: 1.5rem"
                                    ></i>
                                    <h2
                                        class="text-2xl font-bold font-[Poppins]"
                                    >
                                        JobConnect
                                    </h2>
                                </Link>
                            </div>
                        </div>

                        <!-- Navigation Links -->
                        <div
                            class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex"
                        >
                            <!-- <NavLink
                                :href="route('dashboard')"
                                :active="route().current('dashboard')"
                            >
                                Find Jobs
                            </NavLink>
                            <NavLink
                                :href="route('companies')"
                                :active="route().current('companies')"
                            >
                                Companies
                            </NavLink> -->
                        </div>

                        <!-- Profile Dropdown -->
                        <div class="hidden sm:ms-6 sm:flex sm:items-center">
                            <!-- Applying as Recruiter -->
                            <div class="">
                                <!-- <Link
                                    :href="route('recruiter.index')"
                                    class="bg-primary text-white px-4 py-2 rounded-md"
                                >
                                    Apply as Recruiter
                                </Link> -->
                            </div>
                            <!-- Settings Dropdown -->
                            <div class="relative ms-3">
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none"
                                            >
                                                <Avatar
                                                    :label="
                                                        $page.props.auth.user.name.charAt(
                                                            0
                                                        )
                                                    "
                                                    shape="circle"
                                                />
                                            </button>
                                        </span>
                                    </template>

                                    <template #content class="z-50">
                                        <DropdownLink
                                            :href="route('profile.index')"
                                        >
                                            Profile
                                        </DropdownLink>
                                        <DropdownLink
                                            :href="route('logout')"
                                            method="post"
                                            as="button"
                                        >
                                            Log Out
                                        </DropdownLink>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-me-2 flex items-center sm:hidden">
                            <button
                                @click="
                                    showingNavigationDropdown =
                                        !showingNavigationDropdown
                                "
                                class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-500 focus:bg-gray-100 focus:text-gray-500 focus:outline-none"
                            >
                                <svg
                                    class="h-6 w-6"
                                    stroke="currentColor"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        :class="{
                                            hidden: showingNavigationDropdown,
                                            'inline-flex':
                                                !showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        :class="{
                                            hidden: !showingNavigationDropdown,
                                            'inline-flex':
                                                showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div
                    :class="{
                        block: showingNavigationDropdown,
                        hidden: !showingNavigationDropdown,
                    }"
                    class="sm:hidden"
                >
                    <div class="space-y-1 pb-3 pt-2">
                        <ResponsiveNavLink
                            :href="route('dashboard')"
                            :active="route().current('dashboard')"
                        >
                            Dashboard
                        </ResponsiveNavLink>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="border-t border-gray-200 pb-1 pt-4">
                        <div class="px-4">
                            <div class="text-base font-medium text-gray-800">
                                {{ $page.props.auth.user.name }}
                            </div>
                            <div class="text-sm font-medium text-gray-500">
                                {{ $page.props.auth.user.email }}
                            </div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <ResponsiveNavLink :href="route('profile.index')">
                                Profile
                            </ResponsiveNavLink>
                            <ResponsiveNavLink
                                :href="route('logout')"
                                method="post"
                                as="button"
                            >
                                Log Out
                            </ResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header
                class="bg-white shadow pt-16 min-h-screen"
                v-if="$slots.header"
            >
                <div
                    class="mx-auto max-w-7xl pt-16 min-h-screen px-4 py-6 sm:px-6 lg:px-8"
                >
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main class="pt-16">
                <div
                    class="h-[calc(100vh-4rem)] grid grid-cols-1 md:grid-cols-[1fr_4fr]"
                >
                    <!-- Sidebar -->
                    <!-- Sidebar -->
                    <div
                        class="bg-white border sticky top-16 h-[calc(100vh-4rem)] overflow-y-auto"
                    >
                        <div class="p-4 font-bold text-center border">
                            Recruiter Dashboard
                        </div>
                        <div
                            v-for="tab in tabs"
                            :key="tab.name"
                            class="p-2 space-y-2"
                        >
                            <Link
                                :href="tab.href"
                                :class="[
                                    'flex gap-x-2 items-center p-2 rounded-md hover:bg-blue-100',
                                    $page.url === tab.href
                                        ? 'bg-blue-100 font-semibold text-blue-900'
                                        : 'text-blue-700',
                                ]"
                            >
                                <i :class="tab.icon"></i>
                                {{ tab.name }}
                            </Link>
                        </div>
                    </div>
                    <!-- Right side main content -->
                    <div class="h-full overflow-y-auto p-4">
                        <slot />
                    </div>
                </div>
            </main>

            <!-- Components -->
            <Toast />
            <ConfirmDialog></ConfirmDialog>
        </div>
    </div>
</template>
