<script setup>
const props = defineProps({
    applicant: Object,
});

console.log(props.applicant);

const formatDate = (date) => {
    return new Date(date).toLocaleDateString();
};
</script>

<template>
    <div class="bg-white p-4 rounded-lg shadow-md mt-4">
        <p class="font-[Poppins] text-xl font-bold">Basic Information</p>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
            <div class="flex items-center gap-x-4">
                <i class="pi pi-user"></i>
                <p>
                    <span class="font-semibold mr-2">Full Name:</span
                    >{{ applicant.user.name }}
                </p>
            </div>
            <div class="flex items-center gap-x-4">
                <i class="pi pi-envelope"></i>
                <p>
                    <span class="font-semibold mr-2">Email:</span
                    >{{ applicant.user.email }}
                </p>
            </div>
            <div class="flex items-center gap-x-4">
                <i class="pi pi-phone"></i>
                <p>
                    <span class="font-semibold mr-2">Phone:</span
                    >{{ applicant.user.phone }}
                </p>
            </div>
            <div class="flex items-center gap-x-4">
                <i class="pi pi-map-marker"></i>
                <p>
                    <span class="font-semibold mr-2">Location</span
                    >{{ applicant.user.address }}
                </p>
            </div>
            <div class="flex items-center gap-x-4">
                <i class="pi pi-briefcase"></i>
                <p>
                    <span class="font-semibold mr-2">Position:</span
                    >{{ applicant.user.headline }}
                </p>
            </div>
            <div class="flex items-center gap-x-4">
                <i class="pi pi-calendar"></i>
                <p>
                    <span class="font-semibold mr-2">Applied:</span
                    >{{ formatDate(applicant.created_at) }}
                </p>
            </div>
        </div>
    </div>
</template>
