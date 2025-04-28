<script setup>
import axios from "axios";
import { Button, FileUpload, useToast } from "primevue";
import { ref } from "vue";

const props = defineProps({
    user: Object,
});

const toast = useToast();

const resumeFile = ref(
    props.user.resume ? props.user.resume.split("/").pop() : null
); // Extract the file name from the URL if it exists

const coverLetterFile = ref(
    props.user.cover_letter ? props.user.cover_letter.split("/").pop() : null
); // Extract the file name from the URL if it exists

// File name to display in the UI
const resume = ref("");
const coverLetter = ref("");
// File object to store the selected file
const fileObjectResume = ref(null);
const fileObjectCoverLetter = ref(null);

const selectResume = (e) => {
    const file = e.files[0];
    resume.value = e.files[0].name;
    fileObjectResume.value = file;
};

const selectCoverLetter = (e) => {
    const file = e.files[0];
    coverLetter.value = e.files[0].name;
    fileObjectCoverLetter.value = file;
};

const deleteFile = async (data) => {
    let file = null;

    if (data === "resume") {
        file = props.user.resume;
    } else if (data === "coverLetter") {
        file = props.user.cover_letter;
    }

    try {
        const response = await axios.delete(
            `/profile/delete/documents/${props.user.id}`,
            {
                data: {
                    type: data,
                    file: file,
                },
            }
        );

        if (data === "resume") {
            resumeFile.value = null;
            resume.value = null;
        } else if (data === "coverLetter") {
            coverLetterFile.value = null;
            coverLetter.value = null;
        }

        toast.add({
            severity: "success",
            summary: "Success",
            detail: "Document Deleted",
            life: 3000,
        });
    } catch (error) {
        console.error("Error deleting file:", error);
    }
};

const downloadFile = async (data) => {
    let file = null;

    if (data === "resume") {
        file = resumeFile.value;
    } else if (data === "coverLetter") {
        file = coverLetterFile.value;
    }

    if (!file) {
        alert("No file available to download.");
        return;
    }

    // Get the user ID
    const userId = props.user.id;

    try {
        const response = await axios.get(
            `/download/${userId}/${data}/${file}`,
            {
                responseType: "blob", // <-- Important for binary files
            }
        );

        const blob = new Blob([response.data]);
        const downloadUrl = window.URL.createObjectURL(blob);

        const link = document.createElement("a");
        link.href = downloadUrl;
        link.download = file;
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    } catch (error) {
        console.error("Download failed:", error);
        alert("Failed to download file.");
    }
};

const save = async () => {
    try {
        const formData = new FormData();

        // Append actual files to FormData
        if (fileObjectResume.value) {
            formData.append("resume", fileObjectResume.value);
        }
        if (fileObjectCoverLetter.value) {
            formData.append("coverLetter", fileObjectCoverLetter.value);
        }

        if (!fileObjectResume.value && !fileObjectCoverLetter.value) {
            toast.add({
                severity: "error",
                summary: "Error",
                detail: "Upload a file first",
                life: 3000,
            });
        } else {
            toast.add({
                severity: "success",
                summary: "Success",
                detail: "Documents Updated Succesfully",
                life: 3000,
            });
        }
        const response = await axios.post("/profile/edit/documents", formData, {
            headers: {
                "Content-Type": "multipart/form-data",
            },
        });

        console.log("Files saved successfully:", response.data);
    } catch (error) {
        console.error("Error saving files:", error);
    }
};
</script>

<template>
    <div class="bg-white rounded-lg p-5 space-y-4">
        <div class="space-y-6">
            <div>
                <h1 class="font-[Poppins] font-semibold text-2xl">Documents</h1>
                <p class="text-sm text-secondary">
                    Upload your resume, cover letters, and portfolio documents
                </p>
            </div>
        </div>
        <div class="space-y-6">
            <div
                v-if="resume || resumeFile"
                class="rounded-md flex flex-wrap gap-2"
            >
                <p class="font-[Poppins] text-xl font-medium">Resume</p>
                <div
                    class="bg-gray-100 p-3 rounded-lg text-sm flex gap-x-2 items-center justify-between w-full"
                >
                    <div class="flex gap-x-2 items-center">
                        <i
                            class="pi pi-file text-blue-400 bg-blue-100 rounded-md p-2"
                            style="font-size: 1.5rem"
                        ></i>
                        <div>
                            <p class="font-[Poppins] font-semibold text-lg">
                                {{ user.resume ? resumeFile : resume }}
                            </p>
                        </div>
                    </div>
                    <div class="flex gap-x-4 items-center">
                        <i
                            v-if="user.resume"
                            class="pi pi-upload"
                            @click="downloadFile('resume')"
                        ></i>
                        <i
                            class="pi pi-trash text-red-500"
                            @click="deleteFile('resume')"
                        ></i>
                    </div>
                </div>
            </div>
            <div class="flex mt-4">
                <FileUpload
                    ref="fileupload"
                    mode="basic"
                    name="demo[]"
                    :maxFileSize="1000000"
                    @select="selectResume"
                    :customUpload="true"
                    chooseLabel="Resume"
                >
                    <template #filelabel>
                        <span></span>
                    </template>
                </FileUpload>
            </div>

            <!-- For cover letter -->
            <div
                v-if="coverLetter || coverLetterFile"
                class="rounded-md flex flex-wrap gap-2"
            >
                <p class="font-[Poppins] text-xl font-medium">Cover Letter</p>
                <div
                    class="bg-gray-100 p-3 rounded-lg text-sm flex gap-x-2 items-center justify-between w-full"
                >
                    <div class="flex gap-x-2 items-center">
                        <i
                            class="pi pi-file text-blue-400 bg-blue-100 rounded-md p-2"
                            style="font-size: 1.5rem"
                        ></i>
                        <div>
                            <p class="font-[Poppins] font-semibold text-lg">
                                {{
                                    user.cover_letter
                                        ? coverLetterFile
                                        : coverLetter
                                }}
                            </p>
                        </div>
                    </div>
                    <div class="flex gap-x-4 items-center">
                        <i
                            v-if="user.cover_letter"
                            class="pi pi-upload"
                            @click="downloadFile('coverLetter')"
                        ></i>
                        <i
                            class="pi pi-trash text-red-500"
                            @click="deleteFile('coverLetter')"
                        ></i>
                    </div>
                </div>
            </div>
            <div class="flex mt-4">
                <FileUpload
                    ref="fileupload"
                    mode="basic"
                    name="demo[]"
                    :maxFileSize="1000000"
                    @select="selectCoverLetter"
                    :customUpload="true"
                    chooseLabel="Cover Letter"
                >
                    <template #filelabel>
                        <span></span>
                    </template>
                </FileUpload>
            </div>
        </div>
        <div class="flex gap-x-4 justify-end">
            <Button>Cancel</Button>
            <Button @click="save">Save</Button>
        </div>
    </div>
</template>

<style scoped>
:deep(.p-fileupload-file-name),
:deep(.p-fileupload-content),
:deep(.p-fileupload-file-list),
:deep(.p-fileupload-file),
:deep(.p-fileupload-file-info) {
    display: none !important;
}
</style>
