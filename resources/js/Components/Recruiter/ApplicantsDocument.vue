<script setup>
import { ref } from "vue";
import PDFViewer from "../PDFViewer.vue";

const props = defineProps({
    applicant: Object,
});

const isCoverLetterView = ref(false);
const isResumeView = ref(false);
const isImage = ref(false);
const isPDF = ref(false);

const baseURL = "http://127.0.0.1:8000"; // or your API base URL

const getFullURL = (path) => {
    if (!path.startsWith("http")) {
        return baseURL + path;
    }
    return path;
};

const fileExtension = (fileName) => {
    if (
        ["jpg", "jpeg", "png"].includes(fileName.split(".").pop().toLowerCase())
    ) {
        isImage.value = true;
    } else if (
        ["pdf", "docx", "doc"].includes(fileName.split(".").pop().toLowerCase())
    ) {
        isPDF.value = true;
    }
    console.log("File extension check:", {
        isImage: isImage.value,
        isPDF: isPDF.value,
    });
};

const viewDocument = (document) => {
    // Logic to view the document
    console.log("Viewing document:", document);
    if (document.includes("cover_letter")) {
        isCoverLetterView.value = !isCoverLetterView.value;
        fileExtension(document);
    } else if (document.includes("resume")) {
        isResumeView.value = !isResumeView.value;
        fileExtension(document);
    }
};

const downloadDocument = (document) => {
    // Logic to download the document
    console.log("Downloading document:", document);
};
</script>

<template>
    <div>
        <!-- Resume -->
        <div>
            <div v-if="applicant.resume" class="pb-4">
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-x-2">
                        <i class="pi pi-file text-blue-500"></i>
                        <p class="font-semibold text-lg">Resume</p>
                    </div>
                    <div class="flex items-center gap-x-4">
                        <i
                            @click="viewDocument(applicant.resume)"
                            class="pi pi-eye text-blue text-blue-500 border p-2 rounded-md hover:cursor-pointer"
                        ></i>
                        <i
                            @click="downloadDocument(applicant.resume)"
                            class="pi pi-download text-blue text-blue-500 border p-2 rounded-md hover:cursor-pointer"
                        ></i>
                    </div>
                </div>
                <!-- Actual document -->
                <div>
                    <div v-if="isResumeView">
                        <p v-if="isImage" class="text-secondary text-sm">
                            This is an image file.
                        </p>
                        <p v-else-if="isPDF" class="text-secondary text-sm">
                            This is a PDF file.
                        </p>
                        <img
                            v-if="isImage"
                            :src="`/storage/${applicant.resume}`"
                            alt="Resume"
                            class="w-full h-auto"
                        />
                        <PDFViewer
                            :src="`http://127.0.0.1:8000/storage/${applicant.resume}`"
                            v-else-if="isPDF"
                        />
                    </div>
                </div>
            </div>
            <div v-else>
                <p class="text-secondary text-sm">No documents uploaded yet.</p>
            </div>
            <div></div>
        </div>

        <!-- Cover Letter -->
        <div>
            <div v-if="applicant.cover_letter" class="pb-4">
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-x-2">
                        <i class="pi pi-file text-blue-500"></i>
                        <p class="font-semibold text-lg">Cover Letter</p>
                    </div>
                    <div class="flex items-center gap-x-4">
                        <i
                            @click="viewDocument(applicant.cover_letter)"
                            class="pi pi-eye text-blue text-blue-500 border p-2 rounded-md hover:cursor-pointer"
                        ></i>
                        <i
                            @click="downloadDocument(applicant.cover_letter)"
                            class="pi pi-download text-blue text-blue-500 border p-2 rounded-md hover:cursor-pointer"
                        ></i>
                    </div>
                </div>
                <!-- Actual document -->
                <div>
                    <div v-if="isCoverLetterView">
                        <p v-if="isImage" class="text-secondary text-sm">
                            This is an image file.
                        </p>
                        <p v-else-if="isPDF" class="text-secondary text-sm">
                            This is a PDF file.
                        </p>
                        <img
                            v-if="isImage"
                            :src="`/storage/${applicant.cover_letter}`"
                            alt="Resume"
                            class="w-full h-auto"
                        />
                        <PDFViewer
                            :src="`http://127.0.0.1:8000/storage/${applicant.cover_letter}`"
                            v-else-if="isPDF"
                        />
                    </div>
                </div>
            </div>
            <div v-else>
                <p class="text-secondary text-sm">No documents uploaded yet.</p>
            </div>
        </div>
    </div>
</template>
