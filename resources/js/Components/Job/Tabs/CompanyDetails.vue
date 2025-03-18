<script setup>
import { Avatar } from "primevue";
</script>

<template>
    <div class="flex flex-col p-3 gap-y-4">
        <div class="flex gap-x-4 border-b-2 border-gray-200 pb-4">
            <Avatar size="large" shape="circle" icon="pi pi-user" />
            <div>
                <h1 class="font-[Poppins] text-lg font-semibold text-black">
                    TechCorp Inc.
                </h1>
                <p class="text-secondary">
                    Technology · 500-1000 employees · Founded 2010
                </p>
                <div class="flex items-center gap-x-2 mt-2">
                    <i class="pi pi-globe"></i>
                    <a href="#" class="text-header">techcorp.example.com</a>
                </div>
            </div>
        </div>
        <div class="space-y-8">
            <div class="space-y-2">
                <h1 class="font-[Poppins] font-semibold text-black">
                    About the company
                </h1>
                <p class="whitespace-normal">
                    TechCorp is a leading technology company specializing in
                    cloud-based solutions for businesses of all sizes. Founded
                    in 2010, we've grown to over 500 employees across offices in
                    San Francisco, New York, and London. Our mission is to
                    simplify complex technological challenges and empower
                    businesses to achieve more through innovative software
                    solutions. We're committed to creating a diverse and
                    inclusive workplace where all employees can thrive. At
                    TechCorp, we value collaboration, innovation, and continuous
                    learning. We offer a supportive environment where you can
                    grow your career while working on challenging problems that
                    make a real impact.
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-4 mt-4">
                <div class="p-4 border border-gray-200 rounded-lg space-y-2">
                    <p class="font-semibold font-[Poppins] text-black">
                        Industry
                    </p>
                    <p class="text-sm">
                        Software Development, Cloud Computing, Enterprise
                        Solutions
                    </p>
                </div>
                <div class="p-4 border border-gray-200 rounded-lg space-y-2">
                    <p class="font-semibold font-[Poppins] text-black">
                        Company size
                    </p>
                    <p class="text-sm">500-1000 employees</p>
                </div>
                <div class="p-4 border border-gray-200 rounded-lg space-y-2">
                    <p class="font-semibold font-[Poppins] text-black">
                        Founded
                    </p>
                    <p class="text-sm">2010</p>
                </div>
                <div class="p-4 border border-gray-200 rounded-lg space-y-2">
                    <p class="font-semibold font-[Poppins] text-black">
                        Headquarters
                    </p>
                    <p class="text-sm">San Francisco, California</p>
                </div>
            </div>
        </div>
    </div>
</template>
