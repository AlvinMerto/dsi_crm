<?php

namespace Modules\ActivityLog\Providers;

use App\Events\BankTransferPaymentStatus;
use App\Events\ConvertToInvoice;
use App\Events\CreateInvoice;
use App\Events\CreatePaymentInvoice;
use App\Events\CreateProposal;
use App\Events\CreateUser;
use App\Events\DuplicateInvoice;
use App\Events\DuplicateProposal;
use App\Events\PaymentReminderInvoice;
use App\Events\ResentInvoice;
use App\Events\ResentProposal;
use App\Events\SentInvoice;
use App\Events\SentProposal;
use App\Events\StatusChangeProposal;
use App\Events\UpdateInvoice;
use App\Events\UpdateProposal;
use App\Events\UpdateUser;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\AamarPay\Events\AamarPaymentStatus;
use Modules\Account\Events\CreateBankAccount;
use Modules\Account\Events\CreateBankTransfer;
use Modules\Account\Events\CreateBill;
use Modules\Account\Events\CreateCustomer;
use Modules\Account\Events\CreatePayment;
use Modules\Account\Events\CreatePaymentBill;
use Modules\Account\Events\CreateRevenue;
use Modules\Account\Events\CreateVendor;
use Modules\Account\Events\DuplicateBill;
use Modules\Account\Events\ResentBill;
use Modules\Account\Events\SentBill;
use Modules\Account\Events\UpdateBankAccount;
use Modules\Account\Events\UpdateBankTransfer;
use Modules\Account\Events\UpdateBill;
use Modules\Account\Events\UpdateCustomer;
use Modules\Account\Events\UpdatePayment;
use Modules\Account\Events\UpdateRevenue;
use Modules\Account\Events\UpdateVendor;
use Modules\ActivityLog\Listeners\AddDayoffLis;
use Modules\ActivityLog\Listeners\AppointmentStatusLis;
use Modules\ActivityLog\Listeners\BusinessStatusLis;
use Modules\ActivityLog\Listeners\ConvertIntoLeadSettingLis;
use Modules\ActivityLog\Listeners\ConvertToEmployeeLis;
use Modules\ActivityLog\Listeners\ConvertToInvoiceLis;
use Modules\ActivityLog\Listeners\CopyContractLis;
use Modules\ActivityLog\Listeners\CreateAllowanceLis;
use Modules\ActivityLog\Listeners\CreateAnnouncementLis;
use Modules\ActivityLog\Listeners\CreateAppointmentLis;
use Modules\ActivityLog\Listeners\CreateAppointmentsLis;
use Modules\ActivityLog\Listeners\CreateAppraisalLis;
use Modules\ActivityLog\Listeners\CreateAssetsLis;
use Modules\ActivityLog\Listeners\CreateAvailabilityLis;
use Modules\ActivityLog\Listeners\CreateAwardLis;
use Modules\ActivityLog\Listeners\CreateBankAccountLis;
use Modules\ActivityLog\Listeners\CreateBankTransferLis;
use Modules\ActivityLog\Listeners\CreateBillLis;
use Modules\ActivityLog\Listeners\CreateBugLis;
use Modules\ActivityLog\Listeners\CreateBusinessLis;
use Modules\ActivityLog\Listeners\CreateCallLis;
use Modules\ActivityLog\Listeners\CreateChangeOrderLis;
use Modules\ActivityLog\Listeners\CreateCmmsposLis;
use Modules\ActivityLog\Listeners\CreateCommissionLis;
use Modules\ActivityLog\Listeners\CreateCommonCaseLis;
use Modules\ActivityLog\Listeners\CreateCompanyPolicyLis;
use Modules\ActivityLog\Listeners\CreateComplaintLis;
use Modules\ActivityLog\Listeners\CreateComponentLis;
use Modules\ActivityLog\Listeners\CreateContactLis;
use Modules\ActivityLog\Listeners\CreateContractLis;
use Modules\ActivityLog\Listeners\CreateCustomerLis;
use Modules\ActivityLog\Listeners\CreateCustomFieldLis;
use Modules\ActivityLog\Listeners\CreateCustomQuestionLis;
use Modules\ActivityLog\Listeners\CreateDealLis;
use Modules\ActivityLog\Listeners\CreateDealTaskLis;
use Modules\ActivityLog\Listeners\CreateDocumentLis;
use Modules\ActivityLog\Listeners\CreateEmployeeLis;
use Modules\ActivityLog\Listeners\CreateFinacialGoalLis;
use Modules\ActivityLog\Listeners\CreateFormFieldLis;
use Modules\ActivityLog\Listeners\CreateFormLis;
use Modules\ActivityLog\Listeners\CreateGoalTrackingLis;
use Modules\ActivityLog\Listeners\CreateEventLis;
use Modules\ActivityLog\Listeners\CreateHolidaysLis;
use Modules\ActivityLog\Listeners\CreateIndicatorLis;
use Modules\ActivityLog\Listeners\CreateInterviewScheduleLis;
use Modules\ActivityLog\Listeners\CreateInvoiceLis;
use Modules\ActivityLog\Listeners\CreateJobApplicationsLis;
use Modules\ActivityLog\Listeners\CreateJobApplicationStageChangeLis;
use Modules\ActivityLog\Listeners\CreateJobBoardLis;
use Modules\ActivityLog\Listeners\CreateJobLis;
use Modules\ActivityLog\Listeners\CreateLeadLis;
use Modules\ActivityLog\Listeners\CreateLeaveLis;
use Modules\ActivityLog\Listeners\CreateLoanLis;
use Modules\ActivityLog\Listeners\CreateLocationLis;
use Modules\ActivityLog\Listeners\CreateMarkAttendanceLis;
use Modules\ActivityLog\Listeners\CreateMeetingLis;
use Modules\ActivityLog\Listeners\CreateMilestoneLis;
use Modules\ActivityLog\Listeners\CreateMonthlyPayslipLis;
use Modules\ActivityLog\Listeners\CreateNotesLis;
use Modules\ActivityLog\Listeners\CreateOpportunitiesLis;
use Modules\ActivityLog\Listeners\CreateOtherPaymentLis;
use Modules\ActivityLog\Listeners\CreateOvertimeLis;
use Modules\ActivityLog\Listeners\CreatePartLis;
use Modules\ActivityLog\Listeners\CreatePaymentBillLis;
use Modules\ActivityLog\Listeners\CreatePaymentInvoiceLis;
use Modules\ActivityLog\Listeners\CreatePaymentLis;
use Modules\ActivityLog\Listeners\CreatePaymentMonthlyPayslipLis;
use Modules\ActivityLog\Listeners\CreatePaymentPurchaseLis;
use Modules\ActivityLog\Listeners\CreatePaymentRetainerLis;
use Modules\ActivityLog\Listeners\CreatePmsLis;
use Modules\ActivityLog\Listeners\CreateProductLis;
use Modules\ActivityLog\Listeners\CreateProjectLis;
use Modules\ActivityLog\Listeners\CreatePromotionLis;
use Modules\ActivityLog\Listeners\CreateProposalLis;
use Modules\ActivityLog\Listeners\CreatePublicTicketLis;
use Modules\ActivityLog\Listeners\CreatePurchaseLis;
use Modules\ActivityLog\Listeners\CreateQuestionLis;
use Modules\ActivityLog\Listeners\CreateQuoteLis;
use Modules\ActivityLog\Listeners\CreateRatingLis;
use Modules\ActivityLog\Listeners\CreateResignationLis;
use Modules\ActivityLog\Listeners\CreateRetainerLis;
use Modules\ActivityLog\Listeners\CreateRevenueLis;
use Modules\ActivityLog\Listeners\CreateRotaLis;
use Modules\ActivityLog\Listeners\CreateSalesAccountLis;
use Modules\ActivityLog\Listeners\CreateSalesDocumentLis;
use Modules\ActivityLog\Listeners\CreateSalesInvoiceLis;
use Modules\ActivityLog\Listeners\CreateSalesOrderConvertLis;
use Modules\ActivityLog\Listeners\CreateSalesOrderLis;
use Modules\ActivityLog\Listeners\CreateSaturationDeductionLis;
use Modules\ActivityLog\Listeners\CreateSupplierLis;
use Modules\ActivityLog\Listeners\CreateTaskLis;
use Modules\ActivityLog\Listeners\CreateTemplateLis;
use Modules\ActivityLog\Listeners\CreateTerminationLis;
use Modules\ActivityLog\Listeners\CreateTicketLis;
use Modules\ActivityLog\Listeners\CreateTimesheetLis;
use Modules\ActivityLog\Listeners\CreateTrainerLis;
use Modules\ActivityLog\Listeners\CreateTrainingLis;
use Modules\ActivityLog\Listeners\CreateTransferLis;
use Modules\ActivityLog\Listeners\CreateTripLis;
use Modules\ActivityLog\Listeners\CreateUserLis;
use Modules\ActivityLog\Listeners\CreateVendorLis;
use Modules\ActivityLog\Listeners\CreateWarehouseLis;
use Modules\ActivityLog\Listeners\CreateWarningLis;
use Modules\ActivityLog\Listeners\CreateWorkorderLis;
use Modules\ActivityLog\Listeners\CreateWorkrequestLis;
use Modules\ActivityLog\Listeners\CreateZoommeetingLis;
use Modules\ActivityLog\Listeners\DealAddCallLis;
use Modules\ActivityLog\Listeners\DealAddClientLis;
use Modules\ActivityLog\Listeners\DealAddDiscussionLis;
use Modules\ActivityLog\Listeners\DealAddEmailLis;
use Modules\ActivityLog\Listeners\DealAddNoteLis;
use Modules\ActivityLog\Listeners\DealAddProductLis;
use Modules\ActivityLog\Listeners\DealAddUserLis;
use Modules\ActivityLog\Listeners\DealCallUpdateLis;
use Modules\ActivityLog\Listeners\DealMovedLis;
use Modules\ActivityLog\Listeners\DealSourceUpdateLis;
use Modules\ActivityLog\Listeners\DealUploadFileLis;
use Modules\ActivityLog\Listeners\DuplicateBillLis;
use Modules\ActivityLog\Listeners\DuplicateInvoiceLis;
use Modules\ActivityLog\Listeners\DuplicateProposalLis;
use Modules\ActivityLog\Listeners\ImageGeneratLis;
use Modules\ActivityLog\Listeners\InvoicePaymentLis;
use Modules\ActivityLog\Listeners\JobApplicationArchiveLis;
use Modules\ActivityLog\Listeners\JobApplicationChangeOrderLis;
use Modules\ActivityLog\Listeners\LeadAddCallLis;
use Modules\ActivityLog\Listeners\LeadAddDiscussionLis;
use Modules\ActivityLog\Listeners\LeadAddEmailLis;
use Modules\ActivityLog\Listeners\LeadAddNoteLis;
use Modules\ActivityLog\Listeners\LeadAddProductLis;
use Modules\ActivityLog\Listeners\LeadAddUserLis;
use Modules\ActivityLog\Listeners\LeadConvertDealLis;
use Modules\ActivityLog\Listeners\LeadMovedLis;
use Modules\ActivityLog\Listeners\LeadSourceUpdateLis;
use Modules\ActivityLog\Listeners\LeadUpdateCallLis;
use Modules\ActivityLog\Listeners\LeadUploadFileLis;
use Modules\ActivityLog\Listeners\LeaveStatusLis;
use Modules\ActivityLog\Listeners\PaymentReminderInvoiceLis;
use Modules\ActivityLog\Listeners\PayslipSendLis;
use Modules\ActivityLog\Listeners\ProjectInviteUserLis;
use Modules\ActivityLog\Listeners\ProjectShareToClientLis;
use Modules\ActivityLog\Listeners\ProjectUploadFilesLis;
use Modules\ActivityLog\Listeners\QuoteDuplicateLis;
use Modules\ActivityLog\Listeners\ResentBillLis;
use Modules\ActivityLog\Listeners\ResentInvoiceLis;
use Modules\ActivityLog\Listeners\ResentProposalLis;
use Modules\ActivityLog\Listeners\ResentPurchaseLis;
use Modules\ActivityLog\Listeners\ResentRetainerLis;
use Modules\ActivityLog\Listeners\RetainerConvertToInvoiceLis;
use Modules\ActivityLog\Listeners\RetainerDuplicateLis;
use Modules\ActivityLog\Listeners\SalesInvoiceItemDuplicateLis;
use Modules\ActivityLog\Listeners\SalesOrderDuplicateLis;
use Modules\ActivityLog\Listeners\SendMailContractLis;
use Modules\ActivityLog\Listeners\SendRotasViaEmailLis;
use Modules\ActivityLog\Listeners\SentBillLis;
use Modules\ActivityLog\Listeners\SentInvoiceLis;
use Modules\ActivityLog\Listeners\SentProposalLis;
use Modules\ActivityLog\Listeners\SentPurchaseLis;
use Modules\ActivityLog\Listeners\SentRetainerLis;
use Modules\ActivityLog\Listeners\StatusChangeDealTaskLis;
use Modules\ActivityLog\Listeners\StatusChangeProposalLis;
use Modules\ActivityLog\Listeners\UpdateAllowanceLis;
use Modules\ActivityLog\Listeners\UpdateAnnouncementLis;
use Modules\ActivityLog\Listeners\UpdateAppointmentLis;
use Modules\ActivityLog\Listeners\UpdateAppraisalLis;
use Modules\ActivityLog\Listeners\UpdateAssetsLis;
use Modules\ActivityLog\Listeners\UpdateAvailabilityLis;
use Modules\ActivityLog\Listeners\UpdateAwardLis;
use Modules\ActivityLog\Listeners\UpdateBankAccountLis;
use Modules\ActivityLog\Listeners\UpdateBankTransferLis;
use Modules\ActivityLog\Listeners\UpdateBillLis;
use Modules\ActivityLog\Listeners\UpdateBugLis;
use Modules\ActivityLog\Listeners\UpdateBugStageLis;
use Modules\ActivityLog\Listeners\UpdateBulkAttendanceLis;
use Modules\ActivityLog\Listeners\UpdateBusinessLis;
use Modules\ActivityLog\Listeners\UpdateCallLis;
use Modules\ActivityLog\Listeners\UpdateCmmsposLis;
use Modules\ActivityLog\Listeners\UpdateCommissionLis;
use Modules\ActivityLog\Listeners\UpdateCommonCaseLis;
use Modules\ActivityLog\Listeners\UpdateCompanyPolicyLis;
use Modules\ActivityLog\Listeners\UpdateComplaintLis;
use Modules\ActivityLog\Listeners\UpdateComponentLis;
use Modules\ActivityLog\Listeners\UpdateContactLis;
use Modules\ActivityLog\Listeners\UpdatecontractLis;
use Modules\ActivityLog\Listeners\UpdateCustomerLis;
use Modules\ActivityLog\Listeners\UpdateCustomFieldLis;
use Modules\ActivityLog\Listeners\UpdateCustomQuestionLis;
use Modules\ActivityLog\Listeners\UpdateDealLis;
use Modules\ActivityLog\Listeners\UpdateDealTaskLis;
use Modules\ActivityLog\Listeners\UpdateDocumentLis;
use Modules\ActivityLog\Listeners\UpdateEmployeeLis;
use Modules\ActivityLog\Listeners\UpdateEmployeeSalaryLis;
use Modules\ActivityLog\Listeners\UpdateFinacialGoalLis;
use Modules\ActivityLog\Listeners\UpdateFormFieldLis;
use Modules\ActivityLog\Listeners\UpdateFormLis;
use Modules\ActivityLog\Listeners\UpdateGoalTrackingLis;
use Modules\ActivityLog\Listeners\UpdateEventLis;
use Modules\ActivityLog\Listeners\UpdateHistoryLis;
use Modules\ActivityLog\Listeners\UpdateHolidaysLis;
use Modules\ActivityLog\Listeners\UpdateInterviewScheduleLis;
use Modules\ActivityLog\Listeners\UpdateInvoiceLis;
use Modules\ActivityLog\Listeners\UpdateJobBoardLis;
use Modules\ActivityLog\Listeners\UpdateJobLis;
use Modules\ActivityLog\Listeners\UpdateLeadLis;
use Modules\ActivityLog\Listeners\UpdateLeaveLis;
use Modules\ActivityLog\Listeners\UpdateLoanLis;
use Modules\ActivityLog\Listeners\UpdateLocationLis;
use Modules\ActivityLog\Listeners\UpdateMarkAttendanceLis;
use Modules\ActivityLog\Listeners\UpdateMeetingLis;
use Modules\ActivityLog\Listeners\UpdateMilestoneLis;
use Modules\ActivityLog\Listeners\UpdateMonthlyPayslipLis;
use Modules\ActivityLog\Listeners\UpdateNotesLis;
use Modules\ActivityLog\Listeners\UpdateOpportunitiesLis;
use Modules\ActivityLog\Listeners\UpdateOtherPaymentLis;
use Modules\ActivityLog\Listeners\UpdateOvertimeLis;
use Modules\ActivityLog\Listeners\UpdatePartLis;
use Modules\ActivityLog\Listeners\UpdatePaymentLis;
use Modules\ActivityLog\Listeners\UpdatePmsLis;
use Modules\ActivityLog\Listeners\UpdateProductLis;
use Modules\ActivityLog\Listeners\UpdateProjectLis;
use Modules\ActivityLog\Listeners\UpdatePromotionLis;
use Modules\ActivityLog\Listeners\UpdateProposalLis;
use Modules\ActivityLog\Listeners\UpdatePurchaseLis;
use Modules\ActivityLog\Listeners\UpdateQuestionLis;
use Modules\ActivityLog\Listeners\UpdateQuoteLis;
use Modules\ActivityLog\Listeners\UpdateResignationLis;
use Modules\ActivityLog\Listeners\UpdateRetainerLis;
use Modules\ActivityLog\Listeners\UpdateRevenueLis;
use Modules\ActivityLog\Listeners\UpdateRotaLis;
use Modules\ActivityLog\Listeners\UpdateSalesAccountLis;
use Modules\ActivityLog\Listeners\UpdateSalesDocumentLis;
use Modules\ActivityLog\Listeners\UpdateSalesInvoiceLis;
use Modules\ActivityLog\Listeners\UpdateSalesOrderLis;
use Modules\ActivityLog\Listeners\UpdateSaturationDeductionLis;
use Modules\ActivityLog\Listeners\UpdateSupplierLis;
use Modules\ActivityLog\Listeners\UpdateTaskLis;
use Modules\ActivityLog\Listeners\UpdateTaskStageLis;
use Modules\ActivityLog\Listeners\UpdateTemplateLis;
use Modules\ActivityLog\Listeners\UpdateTerminationLis;
use Modules\ActivityLog\Listeners\UpdateTicketLis;
use Modules\ActivityLog\Listeners\UpdateTimesheetLis;
use Modules\ActivityLog\Listeners\UpdateTrainerLis;
use Modules\ActivityLog\Listeners\UpdateTrainingLis;
use Modules\ActivityLog\Listeners\UpdateTransferLis;
use Modules\ActivityLog\Listeners\UpdateTripLis;
use Modules\ActivityLog\Listeners\UpdateUserLis;
use Modules\ActivityLog\Listeners\UpdateVendorLis;
use Modules\ActivityLog\Listeners\UpdateWarehouseLis;
use Modules\ActivityLog\Listeners\UpdateWarningLis;
use Modules\ActivityLog\Listeners\UpdateWorkorderLis;
use Modules\ActivityLog\Listeners\UpdateWorkScheduleLis;
use Modules\ActivityLog\Listeners\VcardCreateAppointmentLis;
use Modules\ActivityLog\Listeners\VcardCreateContactLis;
use Modules\ActivityLog\Listeners\VcardUpdateAppointmentLis;
use Modules\ActivityLog\Listeners\VcardUpdateContactLis;
use Modules\ActivityLog\Listeners\ViewFormLis;
use Modules\AIDocument\Events\UpdateHistory;
use Modules\AIImage\Events\ImageGenerat;
use Modules\Appointment\Events\AppointmentStatus;
use Modules\Appointment\Events\CreateAppointment;
use Modules\Appointment\Events\CreateAppointments;
use Modules\Appointment\Events\CreateQuestion;
use Modules\Appointment\Events\UpdateAppointment;
use Modules\Appointment\Events\UpdateQuestion;
use Modules\Assets\Events\CreateAssets;
use Modules\Assets\Events\UpdateAssets;
use Modules\Benefit\Events\BenefitPaymentStatus;
use Modules\Cashfree\Events\CashfreePaymentStatus;
use Modules\CMMS\Events\CreateCmmspos;
use Modules\CMMS\Events\CreateComponent;
use Modules\CMMS\Events\CreateLocation;
use Modules\CMMS\Events\CreatePart;
use Modules\CMMS\Events\CreatePms;
use Modules\CMMS\Events\CreateSupplier;
use Modules\CMMS\Events\CreateWorkorder;
use Modules\CMMS\Events\CreateWorkrequest;
use Modules\CMMS\Events\UpdateCmmspos;
use Modules\CMMS\Events\UpdateComponent;
use Modules\CMMS\Events\UpdateLocation;
use Modules\CMMS\Events\UpdatePart;
use Modules\CMMS\Events\UpdatePms;
use Modules\CMMS\Events\UpdateSupplier;
use Modules\CMMS\Events\UpdateWorkorder;
use Modules\Coingate\Events\CoingatePaymentStatus;
use Modules\Contract\Events\CopyContract;
use Modules\Contract\Events\CreateContract;
use Modules\Contract\Events\SendMailContract;
use Modules\contract\Events\Updatecontract;
use Modules\CustomField\Events\CreateCustomField;
use Modules\CustomField\Events\UpdateCustomField;
use Modules\Feedback\Events\CreateRating;
use Modules\Feedback\Events\CreateTemplate;
use Modules\Feedback\Events\UpdateTemplate;
use Modules\Flutterwave\Events\FlutterwavePaymentStatus;
use Modules\FormBuilder\Events\ConvertIntoLeadSetting;
use Modules\FormBuilder\Events\CreateForm;
use Modules\FormBuilder\Events\CreateFormField;
use Modules\FormBuilder\Events\UpdateForm;
use Modules\FormBuilder\Events\UpdateFormField;
use Modules\FormBuilder\Events\ViewForm;
use Modules\Goal\Events\CreateFinacialGoal;
use Modules\Goal\Events\UpdateFinacialGoal;
use Modules\Hrm\Events\CreateAllowance;
use Modules\Hrm\Events\CreateAnnouncement;
use Modules\Hrm\Events\CreateAward;
use Modules\Hrm\Events\CreateCommission;
use Modules\Hrm\Events\CreateCompanyPolicy;
use Modules\Hrm\Events\CreateComplaint;
use Modules\Hrm\Events\CreateDocument;
use Modules\Hrm\Events\CreateEmployee;
use Modules\Hrm\Events\CreateEvent;
use Modules\Hrm\Events\CreateHolidays;
use Modules\Hrm\Events\CreateLeave;
use Modules\Hrm\Events\CreateLoan;
use Modules\Hrm\Events\CreateMarkAttendance;
use Modules\Hrm\Events\CreateMonthlyPayslip;
use Modules\Hrm\Events\CreateOtherPayment;
use Modules\Hrm\Events\CreateOvertime;
use Modules\Hrm\Events\CreatePaymentMonthlyPayslip;
use Modules\Hrm\Events\CreatePromotion;
use Modules\Hrm\Events\CreateResignation;
use Modules\Hrm\Events\CreateSaturationDeduction;
use Modules\Hrm\Events\CreateTermination;
use Modules\Hrm\Events\CreateTransfer;
use Modules\Hrm\Events\CreateTrip;
use Modules\Hrm\Events\CreateWarning;
use Modules\Hrm\Events\LeaveStatus;
use Modules\Hrm\Events\PayslipSend;
use Modules\Hrm\Events\UpdateAllowance;
use Modules\Hrm\Events\UpdateAnnouncement;
use Modules\Hrm\Events\UpdateAward;
use Modules\Hrm\Events\UpdateBulkAttendance;
use Modules\Hrm\Events\UpdateCommission;
use Modules\Hrm\Events\UpdateCompanyPolicy;
use Modules\Hrm\Events\UpdateComplaint;
use Modules\Hrm\Events\UpdateDocument;
use Modules\Hrm\Events\UpdateEmployee;
use Modules\Hrm\Events\UpdateEmployeeSalary;
use Modules\Hrm\Events\UpdateEvent;
use Modules\Hrm\Events\UpdateHolidays;
use Modules\Hrm\Events\UpdateLeave;
use Modules\Hrm\Events\UpdateLoan;
use Modules\Hrm\Events\UpdateMarkAttendance;
use Modules\Hrm\Events\UpdateMonthlyPayslip;
use Modules\Hrm\Events\UpdateOtherPayment;
use Modules\Hrm\Events\UpdateOvertime;
use Modules\Hrm\Events\UpdatePromotion;
use Modules\Hrm\Events\UpdateResignation;
use Modules\Hrm\Events\UpdateSaturationDeduction;
use Modules\Hrm\Events\UpdateTermination;
use Modules\Hrm\Events\UpdateTransfer;
use Modules\Hrm\Events\UpdateTrip;
use Modules\Hrm\Events\UpdateWarning;
use Modules\Iyzipay\Events\IyzipayPaymentStatus;
use Modules\Lead\Events\CreateDeal;
use Modules\Lead\Events\CreateDealTask;
use Modules\Lead\Events\CreateLead;
use Modules\Lead\Events\DealAddCall;
use Modules\Lead\Events\DealAddClient;
use Modules\Lead\Events\DealAddDiscussion;
use Modules\Lead\Events\DealAddEmail;
use Modules\Lead\Events\DealAddNote;
use Modules\Lead\Events\DealAddProduct;
use Modules\Lead\Events\DealAddUser;
use Modules\Lead\Events\DealCallUpdate;
use Modules\Lead\Events\DealMoved;
use Modules\Lead\Events\DealSourceUpdate;
use Modules\Lead\Events\DealUploadFile;
use Modules\Lead\Events\LeadAddCall;
use Modules\Lead\Events\LeadAddDiscussion;
use Modules\Lead\Events\LeadAddEmail;
use Modules\Lead\Events\LeadAddNote;
use Modules\Lead\Events\LeadAddProduct;
use Modules\Lead\Events\LeadAddUser;
use Modules\Lead\Events\LeadConvertDeal;
use Modules\Lead\Events\LeadMoved;
use Modules\Lead\Events\LeadSourceUpdate;
use Modules\Lead\Events\LeadUpdateCall;
use Modules\Lead\Events\LeadUploadFile;
use Modules\Lead\Events\StatusChangeDealTask;
use Modules\Lead\Events\UpdateDeal;
use Modules\Lead\Events\UpdateDealTask;
use Modules\Lead\Events\UpdateLead;
use Modules\Mercado\Events\MercadoPaymentStatus;
use Modules\Mollie\Events\MolliePaymentStatus;
use Modules\Notes\Events\CreateNotes;
use Modules\Notes\Events\UpdateNotes;
use Modules\Payfast\Events\PayfastPaymentStatus;
use Modules\Paypal\Events\PaypalPaymentStatus;
use Modules\Paystack\Events\PaystackPaymentStatus;
use Modules\PayTab\Events\PaytabPaymentStatus;
use Modules\Paytm\Events\PaytmPaymentStatus;
use Modules\PayTR\Events\PaytrPaymentStatus;
use Modules\Performance\Events\CreateAppraisal;
use Modules\Performance\Events\CreateGoalTracking;
use Modules\Performance\Events\CreateIndicator;
use Modules\Performance\Events\UpdateAppraisal;
use Modules\Performance\Events\UpdateGoalTracking;
use Modules\Performance\Events\UpdateIndicator;
use Modules\Pos\Events\CreatePaymentPurchase;
use Modules\Pos\Events\CreatePurchase;
use Modules\Pos\Events\CreateWarehouse;
use Modules\Pos\Events\ResentPurchase;
use Modules\Pos\Events\SentPurchase;
use Modules\Pos\Events\UpdatePurchase;
use Modules\Pos\Events\UpdateWarehouse;
use Modules\ProductService\Events\CreateProduct;
use Modules\ProductService\Events\UpdateProduct;
use Modules\Razorpay\Events\RazorpayPaymentStatus;
use Modules\Recruitment\Events\ConvertToEmployee;
use Modules\Recruitment\Events\CreateCustomQuestion;
use Modules\Recruitment\Events\CreateInterviewSchedule;
use Modules\Recruitment\Events\CreateJob;
use Modules\Recruitment\Events\CreateJobApplications;
use Modules\Recruitment\Events\CreateJobApplicationStageChange;
use Modules\Recruitment\Events\CreateJobBoard;
use Modules\Recruitment\Events\JobApplicationArchive;
use Modules\Recruitment\Events\JobApplicationChangeOrder;
use Modules\Recruitment\Events\UpdateCustomQuestion;
use Modules\Recruitment\Events\UpdateInterviewSchedule;
use Modules\Recruitment\Events\UpdateJob;
use Modules\Recruitment\Events\UpdateJobBoard;
use Modules\Retainer\Events\CreatePaymentRetainer;
use Modules\Retainer\Events\CreateRetainer;
use Modules\Retainer\Events\ResentRetainer;
use Modules\Retainer\Events\RetainerConvertToInvoice;
use Modules\Retainer\Events\RetainerDuplicate;
use Modules\Retainer\Events\SentRetainer;
use Modules\Retainer\Events\UpdateRetainer;
use Modules\Rotas\Events\AddDayoff;
use Modules\Rotas\Events\CreateAvailability;
use Modules\Rotas\Events\CreateRota;
use Modules\Rotas\Events\SendRotasViaEmail;
use Modules\Rotas\Events\UpdateAvailability;
use Modules\Rotas\Events\UpdateRota;
use Modules\Rotas\Events\UpdateWorkSchedule;
use Modules\Sales\Events\CreateCall;
use Modules\Sales\Events\CreateChangeOrder;
use Modules\Sales\Events\CreateCommonCase;
use Modules\Sales\Events\CreateContact;
use Modules\Sales\Events\CreateMeeting;
use Modules\Sales\Events\CreateOpportunities;
use Modules\Sales\Events\CreateQuote;
use Modules\Sales\Events\CreateSalesAccount;
use Modules\Sales\Events\CreateSalesDocument;
use Modules\Sales\Events\CreateSalesInvoice;
use Modules\Sales\Events\CreateSalesOrder;
use Modules\Sales\Events\CreateSalesOrderConvert;
use Modules\Sales\Events\QuoteDuplicate;
use Modules\Sales\Events\SalesInvoiceItemDuplicate;
use Modules\Sales\Events\SalesOrderDuplicate;
use Modules\Sales\Events\UpdateCall;
use Modules\Sales\Events\UpdateCommonCase;
use Modules\Sales\Events\UpdateContact;
use Modules\Sales\Events\UpdateMeeting;
use Modules\Sales\Events\UpdateOpportunities;
use Modules\Sales\Events\UpdateQuote;
use Modules\Sales\Events\UpdateSalesAccount;
use Modules\Sales\Events\UpdateSalesDocument;
use Modules\Sales\Events\UpdateSalesInvoice;
use Modules\Sales\Events\UpdateSalesOrder;
use Modules\Skrill\Events\SkrillPaymentStatus;
use Modules\SSPay\Events\SSpayPaymentStatus;
use Modules\Stripe\Events\StripePaymentStatus;
use Modules\SupportTicket\Events\CreatePublicTicket;
use Modules\SupportTicket\Events\CreateTicket;
use Modules\SupportTicket\Events\UpdateTicket;
use Modules\Taskly\Events\CreateBug;
use Modules\Taskly\Events\CreateMilestone;
use Modules\Taskly\Events\CreateProject;
use Modules\Taskly\Events\CreateTask;
use Modules\Taskly\Events\ProjectInviteUser;
use Modules\Taskly\Events\ProjectShareToClient;
use Modules\Taskly\Events\ProjectUploadFiles;
use Modules\Taskly\Events\UpdateBug;
use Modules\Taskly\Events\UpdateBugStage;
use Modules\Taskly\Events\UpdateMilestone;
use Modules\Taskly\Events\Updateproject;
use Modules\Taskly\Events\UpdateTask;
use Modules\Taskly\Events\UpdateTaskStage;
use Modules\Timesheet\Events\CreateTimesheet;
use Modules\Timesheet\Events\UpdateTimesheet;
use Modules\Toyyibpay\Events\ToyyibpayPaymentStatus;
use Modules\Training\Events\CreateTrainer;
use Modules\Training\Events\CreateTraining;
use Modules\Training\Events\UpdateTrainer;
use Modules\Training\Events\UpdateTraining;
use Modules\VCard\Events\BusinessStatus;
use Modules\VCard\Events\CreateAppointment as VcardCreateAppointment;
use Modules\VCard\Events\CreateBusiness;
use Modules\VCard\Events\CreateContact as VcardCreateContact;
use Modules\VCard\Events\UpdateAppointment as VcardUpdateAppointment;
use Modules\VCard\Events\UpdateBusiness;
use Modules\VCard\Events\UpdateContact as VcardUpdateContact;
use Modules\YooKassa\Events\YooKassaPaymentStatus;
use Modules\ZoomMeeting\Events\CreateZoommeeting;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    protected $listen = [
    // CRM
        CreateLead::class => [
            CreateLeadLis::class
        ],
        LeadMoved::class => [
            LeadMovedLis::class
        ],
        UpdateLead::class => [
            UpdateLeadLis::class
        ],
        LeadConvertDeal::class => [
            LeadConvertDealLis::class
        ],
        CreateDeal::class => [
            CreateDealLis::class
        ],
        DealMoved::class => [
            DealMovedLis::class
        ],
        UpdateDeal::class => [
            UpdateDealLis::class
        ],
        LeadAddUser::class => [
            LeadAddUserLis::class
        ],
        LeadAddProduct::class => [
            LeadAddProductLis::class
        ],
        LeadSourceUpdate::class => [
            LeadSourceUpdateLis::class
        ],
        LeadAddEmail::class => [
            LeadAddEmailLis::class
        ],
        LeadAddDiscussion::class => [
            LeadAddDiscussionLis::class
        ],
        LeadAddNote::class => [
            LeadAddNoteLis::class
        ],
        LeadUploadFile::class => [
            LeadUploadFileLis::class
        ],
        LeadAddCall::class => [
            LeadAddCallLis::class
        ],
        LeadUpdateCall::class => [
            LeadUpdateCallLis::class
        ],
        CreateDealTask::class => [
            CreateDealTaskLis::class
        ],
        UpdateDealTask::class => [
            UpdateDealTaskLis::class
        ],
        StatusChangeDealTask::class => [
            StatusChangeDealTaskLis::class
        ],
        DealAddUser::class => [
            DealAddUserLis::class
        ],
        DealAddProduct::class => [
            DealAddProductLis::class
        ],
        DealSourceUpdate::class => [
            DealSourceUpdateLis::class
        ],
        DealAddEmail::class => [
            DealAddEmailLis::class
        ],
        DealAddDiscussion::class => [
            DealAddDiscussionLis::class
        ],
        DealAddNote::class => [
            DealAddNoteLis::class
        ],
        DealUploadFile::class => [
            DealUploadFileLis::class
        ],
        DealAddClient::class => [
            DealAddClientLis::class
        ],
        DealAddCall::class => [
            DealAddCallLis::class
        ],
        DealCallUpdate::class => [
            DealCallUpdateLis::class
        ],

    // Form Builder
        CreateForm::class => [
            CreateFormLis::class
        ],
        UpdateForm::class => [
            UpdateFormLis::class
        ],
        ConvertIntoLeadSetting::class => [
            ConvertIntoLeadSettingLis::class
        ],
        CreateFormField::class => [
            CreateFormFieldLis::class
        ],
        UpdateFormField::class => [
            UpdateFormFieldLis::class
        ],
        ViewForm::class => [
            ViewFormLis::class
        ],

    // POS
        CreateWarehouse::class => [
            CreateWarehouseLis::class
        ],
        UpdateWarehouse::class => [
            UpdateWarehouseLis::class
        ],
        CreatePurchase::class => [
            CreatePurchaseLis::class
        ],
        UpdatePurchase::class => [
            UpdatePurchaseLis::class
        ],
        SentPurchase::class => [
            SentPurchaseLis::class
        ],
        ResentPurchase::class => [
            ResentPurchaseLis::class
        ],
        // CreatePaymentPurchase::class => [
        //     CreatePaymentPurchaseLis::class
        // ],

    // Projects
        CreateProject::class => [
            CreateProjectLis::class
        ],
        Updateproject::class => [
            UpdateProjectLis::class
        ],
        CreateMilestone::class => [
            CreateMilestoneLis::class
        ],
        UpdateMilestone::class => [
            UpdateMilestoneLis::class
        ],
        CreateTask::class => [
            CreateTaskLis::class
        ],
        UpdateTask::class => [
            UpdateTaskLis::class
        ],
        UpdateTaskStage::class => [
            UpdateTaskStageLis::class
        ],
        CreateBug::class => [
            CreateBugLis::class
        ],
        UpdateBug::class => [
            UpdateBugLis::class
        ],
        UpdateBugStage::class => [
            UpdateBugStageLis::class
        ],
        ProjectInviteUser::class => [
            ProjectInviteUserLis::class
        ],
        ProjectShareToClient::class => [
            ProjectShareToClientLis::class
        ],
        ProjectUploadFiles::class => [
            ProjectUploadFilesLis::class
        ],

    // Accounting
        CreateCustomer::class => [
            CreateCustomerLis::class
        ],
        UpdateCustomer::class => [
            UpdateCustomerLis::class
        ],
        CreateVendor::class => [
            CreateVendorLis::class
        ],
        UpdateVendor::class => [
            UpdateVendorLis::class
        ],
        // CreateRevenue::class => [
        //     CreateRevenueLis::class
        // ],
        UpdateRevenue::class => [
            UpdateRevenueLis::class
        ],
        CreateBill::class => [
            CreateBillLis::class
        ],
        UpdateBill::class => [
            UpdateBillLis::class
        ],
        SentBill::class => [
            SentBillLis::class
        ],
        ResentBill::class => [
            ResentBillLis::class
        ],
        // CreatePaymentBill::class => [
        //     CreatePaymentBillLis::class
        // ],
        CreatePayment::class => [
            CreatePaymentLis::class
        ],
        UpdatePayment::class => [
            UpdatePaymentLis::class
        ],
        CreateBankAccount::class => [
            CreateBankAccountLis::class
        ],
        UpdateBankAccount::class => [
            UpdateBankAccountLis::class
        ],
        CreateBankTransfer::class => [
            CreateBankTransferLis::class
        ],
        UpdateBankTransfer::class => [
            UpdateBankTransferLis::class
        ],
        DuplicateBill::class => [
            DuplicateBillLis::class
        ],

    // Finacial Goal
        CreateFinacialGoal::class => [
            CreateFinacialGoalLis::class
        ],
        UpdateFinacialGoal::class => [
            UpdateFinacialGoalLis::class
        ],

    // HRM
        CreateMonthlyPayslip::class => [
            CreateMonthlyPayslipLis::class
        ],
        UpdateMonthlyPayslip::class => [
            UpdateMonthlyPayslipLis::class
        ],
        CreatePaymentMonthlyPayslip::class => [
            CreatePaymentMonthlyPayslipLis::class
        ],
        CreateLeave::class => [
            CreateLeaveLis::class
        ],
        UpdateLeave::class => [
            UpdateLeaveLis::class
        ],
        LeaveStatus::class => [
            LeaveStatusLis::class
        ],
        CreateAward::class => [
            CreateAwardLis::class
        ],
        UpdateAward::class => [
            UpdateAwardLis::class
        ],
        CreateTrip::class => [
            CreateTripLis::class
        ],
        UpdateTrip::class => [
            UpdateTripLis::class
        ],
        CreateAnnouncement::class => [
            CreateAnnouncementLis::class
        ],
        UpdateAnnouncement::class => [
            UpdateAnnouncementLis::class
        ],
        CreateHolidays::class => [
            CreateHolidaysLis::class
        ],
        UpdateHolidays::class => [
            UpdateHolidaysLis::class
        ],
        CreateEvent::class => [
            CreateEventLis::class
        ],
        UpdateEvent::class => [
            UpdateEventLis::class
        ],
        CreateCompanyPolicy::class => [
            CreateCompanyPolicyLis::class
        ],
        UpdateCompanyPolicy::class => [
            UpdateCompanyPolicyLis::class
        ],
        CreateEmployee::class => [
            CreateEmployeeLis::class
        ],
        UpdateEmployee::class => [
            UpdateEmployeeLis::class
        ],
        UpdateEmployeeSalary::class => [
            UpdateEmployeeSalaryLis::class
        ],
        CreateAllowance::class => [
            CreateAllowanceLis::class
        ],
        UpdateAllowance::class => [
            UpdateAllowanceLis::class
        ],
        CreateCommission::class => [
            CreateCommissionLis::class
        ],
        UpdateCommission::class => [
            UpdateCommissionLis::class
        ],
        CreateLoan::class => [
            CreateLoanLis::class
        ],
        UpdateLoan::class => [
            UpdateLoanLis::class
        ],
        CreateSaturationDeduction::class => [
            CreateSaturationDeductionLis::class
        ],
        UpdateSaturationDeduction::class => [
            UpdateSaturationDeductionLis::class
        ],
        CreateOtherPayment::class => [
            CreateOtherPaymentLis::class
        ],
        UpdateOtherPayment::class => [
            UpdateOtherPaymentLis::class
        ],
        CreateOvertime::class => [
            CreateOvertimeLis::class
        ],
        UpdateOvertime::class => [
            UpdateOvertimeLis::class
        ],
        CreateMarkAttendance::class => [
            CreateMarkAttendanceLis::class
        ],
        UpdateMarkAttendance::class => [
            UpdateMarkAttendanceLis::class
        ],
        UpdateBulkAttendance::class => [
            UpdateBulkAttendanceLis::class
        ],
        CreateTransfer::class => [
            CreateTransferLis::class
        ],
        UpdateTransfer::class => [
            UpdateTransferLis::class
        ],
        CreateResignation::class => [
            CreateResignationLis::class
        ],
        UpdateResignation::class => [
            UpdateResignationLis::class
        ],
        CreatePromotion::class => [
            CreatePromotionLis::class
        ],
        UpdatePromotion::class => [
            UpdatePromotionLis::class
        ],
        CreateComplaint::class => [
            CreateComplaintLis::class
        ],
        UpdateComplaint::class => [
            UpdateComplaintLis::class
        ],
        CreateWarning::class => [
            CreateWarningLis::class
        ],
        UpdateWarning::class => [
            UpdateWarningLis::class
        ],
        CreateTermination::class => [
            CreateTerminationLis::class
        ],
        UpdateTermination::class => [
            UpdateTerminationLis::class
        ],
        CreateDocument::class => [
            CreateDocumentLis::class
        ],
        UpdateDocument::class => [
            UpdateDocumentLis::class
        ],
        PayslipSend::class => [
            PayslipSendLis::class
        ],

    // Performance
        CreateIndicator::class => [
            CreateIndicatorLis::class
        ],
        UpdateIndicator::class => [
            UpdateIndicatorLis::class
        ],
        CreateAppraisal::class => [
            CreateAppraisalLis::class
        ],
        UpdateAppraisal::class => [
            UpdateAppraisalLis::class
        ],
        CreateGoalTracking::class => [
            CreateGoalTrackingLis::class
        ],
        UpdateGoalTracking::class => [
            UpdateGoalTrackingLis::class
        ],

    // Recruitment
        CreateJob::class => [
            CreateJobLis::class
        ],
        UpdateJob::class => [
            UpdateJobLis::class
        ],
        CreateJobApplications::class => [
            CreateJobApplicationsLis::class
        ],
        CreateInterviewSchedule::class => [
            CreateInterviewScheduleLis::class
        ],
        UpdateInterviewSchedule::class => [
            UpdateInterviewScheduleLis::class
        ],
        ConvertToEmployee::class => [
            ConvertToEmployeeLis::class
        ],
        CreateJobBoard::class => [
            CreateJobBoardLis::class
        ],
        UpdateJobBoard::class => [
            UpdateJobBoardLis::class
        ],
        JobApplicationArchive::class => [
            JobApplicationArchiveLis::class
        ],
        CreateCustomQuestion::class => [
            CreateCustomQuestionLis::class
        ],
        UpdateCustomQuestion::class => [
            UpdateCustomQuestionLis::class
        ],
        JobApplicationChangeOrder::class => [
            JobApplicationChangeOrderLis::class
        ],
        CreateJobApplicationStageChange::class => [
            CreateJobApplicationStageChangeLis::class
        ],

    // Training
        CreateTrainer::class => [
            CreateTrainerLis::class
        ],
        UpdateTrainer::class => [
            UpdateTrainerLis::class
        ],
        CreateTraining::class => [
            CreateTrainingLis::class
        ],
        UpdateTraining::class => [
            UpdateTrainingLis::class
        ],

    // User management
        CreateUser::class => [
            CreateUserLis::class
        ],
        UpdateUser::class => [
            UpdateUserLis::class
        ],

    // Proposal
        CreateProposal::class => [
            CreateProposalLis::class
        ],
        UpdateProposal::class => [
            UpdateProposalLis::class
        ],
        SentProposal::class => [
            SentProposalLis::class
        ],
        ResentProposal::class => [
            ResentProposalLis::class
        ],
        StatusChangeProposal::class => [
            StatusChangeProposalLis::class
        ],
        ConvertToInvoice::class => [
            ConvertToInvoiceLis::class
        ],
        DuplicateProposal::class => [
            DuplicateProposalLis::class
        ],

    // Invoice
        CreateInvoice::class => [
            CreateInvoiceLis::class
        ],
        UpdateInvoice::class => [
            UpdateInvoiceLis::class
        ],
        SentInvoice::class => [
            SentInvoiceLis::class
        ],
        ResentInvoice::class => [
            ResentInvoiceLis::class
        ],
        PaymentReminderInvoice::class => [
            PaymentReminderInvoiceLis::class
        ],
        CreatePaymentInvoice::class => [
            CreatePaymentInvoiceLis::class
        ],
        DuplicateInvoice::class => [
            DuplicateInvoiceLis::class
        ],

    // Product And Services
        CreateProduct::class => [
            CreateProductLis::class
        ],
        UpdateProduct::class => [
            UpdateProductLis::class
        ],

    // Retainer
        CreateRetainer::class => [
            CreateRetainerLis::class
        ],
        UpdateRetainer::class => [
            UpdateRetainerLis::class
        ],
        SentRetainer::class => [
            SentRetainerLis::class
        ],
        ResentRetainer::class => [
            ResentRetainerLis::class
        ],
        // CreatePaymentRetainer::class => [
        //     CreatePaymentRetainerLis::class
        // ],
        RetainerDuplicate::class => [
            RetainerDuplicateLis::class
        ],
        RetainerConvertToInvoice::class => [
            RetainerConvertToInvoiceLis::class
        ],

    // Sales
        CreateQuote::class => [
            CreateQuoteLis::class
        ],
        UpdateQuote::class => [
            UpdateQuoteLis::class
        ],
        CreateSalesInvoice::class => [
            CreateSalesInvoiceLis::class
        ],
        UpdateSalesInvoice::class => [
            UpdateSalesInvoiceLis::class
        ],
        CreateSalesOrder::class => [
            CreateSalesOrderLis::class
        ],
        UpdateSalesOrder::class => [
            UpdateSalesOrderLis::class
        ],
        CreateMeeting::class => [
            CreateMeetingLis::class
        ],
        UpdateMeeting::class => [
            UpdateMeetingLis::class
        ],
        CreateSalesAccount::class => [
            CreateSalesAccountLis::class
        ],
        UpdateSalesAccount::class => [
            UpdateSalesAccountLis::class
        ],
        CreateContact::class => [
            CreateContactLis::class
        ],
        UpdateContact::class => [
            UpdateContactLis::class
        ],
        CreateOpportunities::class => [
            CreateOpportunitiesLis::class
        ],
        UpdateOpportunities::class => [
            UpdateOpportunitiesLis::class
        ],
        CreateChangeOrder::class => [
            CreateChangeOrderLis::class
        ],
        QuoteDuplicate::class => [
            QuoteDuplicateLis::class
        ],
        CreateSalesOrderConvert::class => [
            CreateSalesOrderConvertLis::class
        ],
        SalesOrderDuplicate::class => [
            SalesOrderDuplicateLis::class
        ],
        CreateSalesDocument::class => [
            CreateSalesDocumentLis::class
        ],
        UpdateSalesDocument::class => [
            UpdateSalesDocumentLis::class
        ],
        CreateCommonCase::class => [
            CreateCommonCaseLis::class
        ],
        UpdateCommonCase::class => [
            UpdateCommonCaseLis::class
        ],
        CreateCall::class => [
            CreateCallLis::class
        ],
        UpdateCall::class => [
            UpdateCallLis::class
        ],
        SalesInvoiceItemDuplicate::class => [
            SalesInvoiceItemDuplicateLis::class
        ],

    // Support Ticket
        CreateTicket::class => [
            CreateTicketLis::class
        ],
        UpdateTicket::class => [
            UpdateTicketLis::class
        ],
        CreatePublicTicket::class => [
            CreatePublicTicketLis::class
        ],

    // Rotas
        CreateRota::class => [
            CreateRotaLis::class
        ],
        UpdateRota::class => [
            UpdateRotaLis::class
        ],
        AddDayoff::class => [
            AddDayoffLis::class
        ],
        CreateAvailability::class => [
            CreateAvailabilityLis::class
        ],
        UpdateAvailability::class => [
            UpdateAvailabilityLis::class
        ],
        SendRotasViaEmail::class => [
            SendRotasViaEmailLis::class
        ],
        UpdateWorkSchedule::class => [
            UpdateWorkScheduleLis::class
        ],

    // Contract
        CreateContract::class => [
            CreateContractLis::class
        ],
        Updatecontract::class => [
            UpdatecontractLis::class
        ],
        CopyContract::class => [
            CopyContractLis::class
        ],
        SendMailContract::class => [
            SendMailContractLis::class
        ],

    // Assets
        CreateAssets::class => [
            CreateAssetsLis::class
        ],
        UpdateAssets::class => [
            UpdateAssetsLis::class
        ],

    // Zoom Meeting
        CreateZoommeeting::class => [
            CreateZoommeetingLis::class
        ],

    // Notes
        CreateNotes::class => [
            CreateNotesLis::class
        ],
        UpdateNotes::class => [
            UpdateNotesLis::class
        ],

    // Invoice payment
        StripePaymentStatus::class => [
            InvoicePaymentLis::class
        ],
        SSpayPaymentStatus::class => [
            InvoicePaymentLis::class
        ],
        PaytrPaymentStatus::class => [
            InvoicePaymentLis::class
        ],
        PaypalPaymentStatus::class => [
            InvoicePaymentLis::class
        ],
        CashfreePaymentStatus::class => [
            InvoicePaymentLis::class
        ],
        ToyyibpayPaymentStatus::class => [
            InvoicePaymentLis::class
        ],
        RazorpayPaymentStatus::class => [
            InvoicePaymentLis::class
        ],
        PaystackPaymentStatus::class => [
            InvoicePaymentLis::class
        ],
        MolliePaymentStatus::class => [
            InvoicePaymentLis::class
        ],
        MercadoPaymentStatus::class => [
            InvoicePaymentLis::class
        ],
        FlutterwavePaymentStatus::class => [
            InvoicePaymentLis::class
        ],
        PaytmPaymentStatus::class => [
            InvoicePaymentLis::class
        ],
        PayfastPaymentStatus::class => [
            InvoicePaymentLis::class
        ],
        IyzipayPaymentStatus::class => [
            InvoicePaymentLis::class
        ],
        PaytabPaymentStatus::class => [
            InvoicePaymentLis::class
        ],
        CoingatePaymentStatus::class => [
            InvoicePaymentLis::class
        ],
        SkrillPaymentStatus::class => [
            InvoicePaymentLis::class
        ],
        AamarPaymentStatus::class => [
            InvoicePaymentLis::class
        ],
        BenefitPaymentStatus::class => [
            InvoicePaymentLis::class
        ],
        YooKassaPaymentStatus::class => [
            InvoicePaymentLis::class
        ],
        BankTransferPaymentStatus::class => [
            InvoicePaymentLis::class
        ],

    // Appointment
        CreateAppointment::class => [
            CreateAppointmentLis::class
        ],
        UpdateAppointment::class => [
            UpdateAppointmentLis::class
        ],
        CreateAppointments::class => [
            CreateAppointmentsLis::class
        ],
        AppointmentStatus::class => [
            AppointmentStatusLis::class
        ],
        CreateQuestion::class => [
            CreateQuestionLis::class
        ],
        UpdateQuestion::class => [
            UpdateQuestionLis::class
        ],

    // Feedback
        CreateTemplate::class => [
            CreateTemplateLis::class
        ],
        UpdateTemplate::class => [
            UpdateTemplateLis::class
        ],
        CreateRating::class => [
            CreateRatingLis::class
        ],

    // Custom Field
        CreateCustomField::class => [
            CreateCustomFieldLis::class
        ],
        UpdateCustomField::class => [
            UpdateCustomFieldLis::class
        ],

    // Timesheet
        CreateTimesheet::class => [
            CreateTimesheetLis::class
        ],
        UpdateTimesheet::class => [
            UpdateTimesheetLis::class
        ],

    // vCard
        CreateBusiness::class => [
            CreateBusinessLis::class
        ],
        UpdateBusiness::class => [
            UpdateBusinessLis::class
        ],
        VcardCreateAppointment::class => [
            VcardCreateAppointmentLis::class
        ],
        VcardUpdateAppointment::class => [
            VcardUpdateAppointmentLis::class
        ],
        VcardCreateContact::class => [
            VcardCreateContactLis::class
        ],
        VcardUpdateContact::class => [
            VcardUpdateContactLis::class
        ],
        BusinessStatus::class => [
            BusinessStatusLis::class
        ],

    // CMMS
        CreateLocation::class => [
            CreateLocationLis::class
        ],
        UpdateLocation::class => [
            UpdateLocationLis::class
        ],
        CreateWorkorder::class => [
            CreateWorkorderLis::class
        ],
        // UpdateWorkorder::class => [
        //     UpdateWorkorderLis::class
        // ],
        CreateComponent::class => [
            CreateComponentLis::class
        ],
        // UpdateComponent::class => [
        //     UpdateComponentLis::class
        // ],
        CreatePart::class => [
            CreatePartLis::class
        ],
        // UpdatePart::class => [
        //     UpdatePartLis::class
        // ],
        CreatePms::class => [
            CreatePmsLis::class
        ],
        // UpdatePms::class => [
        //     UpdatePmsLis::class
        // ],
        CreateSupplier::class => [
            CreateSupplierLis::class
        ],
        // UpdateSupplier::class => [
        //     UpdateSupplierLis::class
        // ],
        CreateCmmspos::class => [
            CreateCmmsposLis::class
        ],
        // UpdateCmmspos::class => [
        //     UpdateCmmsposLis::class
        // ],
        CreateWorkrequest::class => [
            CreateWorkrequestLis::class
        ],

    // // AI Image
    //     ImageGenerat::class => [
    //         ImageGeneratLis::class
    //     ],

    // // AI Document
    //     UpdateHistory::class => [
    //         UpdateHistoryLis::class
    //     ],
    ];
}
