<script setup>
import WorkExperience from "./Partials/WorkExperience.vue";
</script>

<template>
    <div class="space-y-6">
        <!-- Professional Summary -->
        <div class="bg-white p-6 rounded-lg space-y-4">
            <h1 class="font-[Poppins] text-xl font-semibold">
                Professional Summary
            </h1>
            <p>
                Senior UX Designer with 7+ years of experience creating
                user-centered digital experiences for products and services.
                Passionate about solving complex problems through design
                thinking and user research. Skilled in creating wireframes,
                prototypes, and high-fidelity designs that balance business
                goals with user needs.
            </p>
        </div>
        <!-- Work Experience -->
        <div class="bg-white p-6 rounded-lg space-y-4">
            <h1 class="font-[Poppins] text-xl font-semibold">
                Work Experience
            </h1>
            <div class="">
                <WorkExperience />
            </div>
        </div>
        <!-- Education -->
        <div class="bg-white p-6 rounded-lg space-y-4">
            <h1 class="font-[Poppins] text-xl font-semibold">Education</h1>
            <div class="flex gap-x-3 items-start">
                <i
                    class="pi pi-graduation-cap border p-2 rounded-lg bg-blue-100 text-blue-700"
                    style="font-size: 1.25em"
                ></i>
                <div>
                    <p class="text-lg font-semibold">
                        Master of Fine Arts in Interaction Design
                    </p>
                    <p class="text-blue-700">California College of the Arts</p>
                    <p>2015 - 2017</p>
                </div>
            </div>
            <!-- ANther -->
            <div class="flex gap-x-3 items-start">
                <i
                    class="pi pi-graduation-cap border p-2 rounded-lg bg-blue-100 text-blue-700"
                    style="font-size: 1.25em"
                ></i>
                <div>
                    <p class="text-lg font-semibold">
                        Master of Fine Arts in Interaction Design
                    </p>
                    <p class="text-blue-700">California College of the Arts</p>
                    <p>2015 - 2017</p>
                </div>
            </div>
        </div>
        <!-- Certifications -->
        <div class="bg-white p-6 rounded-lg space-y-4">
            <h1 class="font-[Poppins] text-xl font-semibold">Certifications</h1>
            <div class="flex gap-x-3 items-start">
                <i
                    class="fa-solid fa-award border p-2 rounded-lg bg-blue-100 text-blue-700"
                    style="font-size: 1.25rem"
                ></i>
                <div>
                    <p class="font-semibold font-[Poppins]">
                        Google UX Design Professional Certificate
                    </p>
                    <p>Issued May 2020</p>
                </div>
            </div>
            <!-- Another -->
            <div class="flex gap-x-3 items-start">
                <i
                    class="fa-solid fa-award border p-2 rounded-lg bg-blue-100 text-blue-700"
                    style="font-size: 1.25rem"
                ></i>
                <div>
                    <p class="font-semibold font-[Poppins]">
                        Certified Usability Analyst (CUA)
                    </p>
                    <p>Issued May 2020</p>
                </div>
            </div>
        </div>
        <!-- Portfolio and Links -->
        <div class="bg-white p-6 rounded-lg space-y-4">
            <h1 class="font-[Poppins] text-xl font-semibold">
                Portfolio & Links
            </h1>
            <div class="space-y-4">
                <div class="flex gap-x-3 items-center justify-between">
                    <div class="flex gap-x-2 items-center">
                        <i class="pi pi-globe"></i>
                        <p>Personal Website</p>
                    </div>
                    <div
                        class="flex gap-x-2 items-center border px-3 py-1 rounded-lg"
                    >
                        <i
                            class="pi pi-external-link"
                            style="font-size: 0.8rem"
                        ></i>
                        <p>Visit</p>
                    </div>
                </div>
                <div class="flex gap-x-3 items-center justify-between">
                    <div class="flex gap-x-2 items-center">
                        <i class="pi pi-github"></i>
                        <p>Github</p>
                    </div>
                    <div
                        class="flex gap-x-2 items-center border px-3 py-1 rounded-lg"
                    >
                        <i
                            class="pi pi-external-link"
                            style="font-size: 0.8rem"
                        ></i>
                        <p>Visit</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
