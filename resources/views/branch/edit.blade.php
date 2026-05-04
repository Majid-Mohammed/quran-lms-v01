<div class="col-12 col-lg-8 main-content-wrapper print-container">
    <form id="branchUpdateForm" action="" method="POST">
        @csrf
        @method('PUT')

        {{-- أزرار التحكم --}}
        <div class="d-flex sticky-top justify-content-start mb-3 d-print-none" style="top: 75px; z-index: 1020;">
            <div id="viewModeButtons">
                <button type="button" onclick="window.print()" class="btn btn-outline-primary shadow-sm">
                    <i class="bi bi-printer-fill me-2"></i> طباعة
                </button>
                <button type="button" onclick="toggleEditMode(true)" class="btn btn-primary shadow-sm ms-2">
                    <i class="bi bi-pencil-square me-2"></i> تعديل البيانات
                </button>
            </div>
            
            <div id="editModeButtons" class="d-none">
                <button type="submit" class="btn btn-success shadow-sm">
                    <i class="bi bi-check-lg me-2"></i> حفظ التغييرات
                </button>
                <button type="button" onclick="toggleEditMode(false)" class="btn btn-light shadow-sm ms-2 border">
                    إلغاء
                </button>
            </div>
        </div>

        <div class="card border-0 shadow-lg rounded-4 overflow-hidden report-card">
            <div class="report-header p-3 text-white bg-dark d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="fw-bold mb-0">تقرير بيانات الفرع</h4>
                    <small class="opacity-75">إدارة حلقات التحفيظ</small>
                </div>
                <div class="text-end">
                    {{-- اسم الفرع قابل للتعديل --}}
                    <h5 class="mb-0 view-field">{{ $branch->name }}</h5>
                    <input type="text" name="name" class="form-control form-control-sm edit-field d-none" value="{{ $branch->name }}" required>
                    <small class="opacity-75">{{ date('Y/m/d') }}</small>
                </div>
            </div>

            <div class="card-body p-4 bg-white">
                <div class="details-section p-4 rounded-3 mb-4" dir="rtl">
                    <h5 class="fw-bold text-primary mb-4 border-bottom pb-2">
                        <i class="bi bi-info-circle-fill me-2"></i> المعلومات الأساسية :
                    </h5>
                    
                    <div class="row g-4">
                        {{-- العنوان --}}
                        <div class="col-6">
                            <label class="text-muted small fw-semibold d-block mb-1">العنوان</label>
                            <span class="text-dark view-field">{{ $branch->address }}</span>
                            <input type="text" name="address" class="form-control edit-field d-none" value="{{ $branch->address }}">
                        </div>

                        {{-- المدينة --}}
                        <div class="col-6">
                            <label class="text-muted small fw-semibold d-block mb-1">المدينة</label>
                            <span class="text-dark view-field">{{ $branch->city }}</span>
                            <input type="text" name="city" class="form-control edit-field d-none" value="{{ $branch->city }}">
                        </div>

                        {{-- رقم الهاتف --}}
                        <div class="col-6">
                            <label class="text-muted small fw-semibold d-block mb-1">رقم الهاتف</label>
                            <span class="text-dark text-ltr d-block view-field">{{ $branch->phone }}</span>
                            <input type="text" name="phone" class="form-control edit-field d-none text-ltr" value="{{ $branch->phone }}">
                        </div>

                        {{-- السعة --}}
                        <div class="col-6">
                            <label class="text-muted small fw-semibold d-block mb-1">السعة الاستيعابية</label>
                            <span class="text-dark view-field">{{ $branch->capacity }} طالب/طالبة</span>
                            <input type="number" name="capacity" class="form-control edit-field d-none" value="{{ $branch->capacity }}">
                        </div>

                        {{-- الحالة --}}
                        <div class="col-12 border-top pt-3">
                            <label class="text-muted small fw-semibold me-3">حالة الفرع:</label>
                            <div class="view-field d-inline">
                                <span class="badge {{ $branch->is_active ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }} px-3 py-2">
                                    {{ $branch->is_active ? 'نشط حالياً' : 'غير نشط' }}
                                </span>
                            </div>
                            <div class="edit-field d-none d-inline">
                                <select name="is_active" class="form-select form-select-sm d-inline-block w-auto">
                                    <option value="1" {{ $branch->is_active ? 'selected' : '' }}>نشط</option>
                                    <option value="0" {{ !$branch->is_active ? 'selected' : '' }}>غير نشط</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>             
                
                <div class="content-area py-3">
                    <h5 class="fw-bold text-primary mb-3">الملاحظات:</h5>
                    <div class="p-3 border rounded-3 bg-light-subtle min-vh-25">
                        <p class="text-muted mb-0 view-field">{{ $branch->notes ?? 'لا توجد ملاحظات...' }}</p>
                        <textarea name="notes" class="form-control edit-field d-none" rows="4">{{ $branch->notes }}</textarea>
                    </div>
                </div>
            </div>

            <div class="d-none d-print-flex justify-content-between p-4 border-top mt-auto">
                <span class="small text-muted">توقيع المسؤول: ....................</span>
                <span class="small text-muted">ختم الفرع</span>
            </div>
        </div>
    </form>
</div>

<style>
    /* تحسينات العرض على الشاشة */
    .report-card {
        transition: transform 0.3s ease;
    }

    .min-vh-25 { min-height: 150px; }

    .details-section {
        background-color: #f8f9fa;
        border: 1px solid #e9ecef;
    }

    .text-ltr { direction: ltr; }

    /* إعدادات الطباعة */
    @media print {
        /* إخفاء كل العناصر غير الضرورية */
        body * { visibility: hidden; }
        .print-container, .print-container * { visibility: visible; }
        
        .print-container {
            position: absolute;
            left: 0;
            top: 0;
            width: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        /* ضبط مقاس الصفحة A4 */
        @page {
            size: A4;
            margin: 1cm;
        }

        /* إزالة الظلال والخلفيات الملونة غير المناسبة للطباعة */
        .card { box-shadow: none !important; border: 1px solid #ddd !important; }
        .report-header { 
            background-color: #000 !important; 
            color: #fff !important; 
            -webkit-print-color-adjust: exact; 
        }
        .details-section { 
            background-color: #fff !important; 
            border: 1px solid #eee !important;
            -webkit-print-color-adjust: exact;
        }
        .badge { border: 1px solid #ccc !important; color: #000 !important; }
        
        /* إخفاء الأزرار */
        .d-print-none { display: none !important; }
        /* تقليل الالوان لعدم استهلاك الحبر */
        .report-header { background-color: gray !important; color: #fff !important; }
    }
</style>


<script>
    function toggleEditMode(isEdit) {
        const viewFields = document.querySelectorAll('.view-field');
        const editFields = document.querySelectorAll('.edit-field');
        const viewButtons = document.getElementById('viewModeButtons');
        const editButtons = document.getElementById('editModeButtons');

        if (isEdit) {
            viewFields.forEach(f => f.classList.add('d-none'));
            editFields.forEach(f => f.classList.remove('d-none'));
            viewButtons.classList.add('d-none');
            editButtons.classList.remove('d-none');
        } else {
            viewFields.forEach(f => f.classList.remove('d-none'));
            editFields.forEach(f => f.classList.add('d-none'));
            viewButtons.classList.remove('d-none');
            editButtons.classList.add('d-none');
        }
    }
</script>