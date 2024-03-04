<?php

// Member Status
class constStatus
{
    const InActive = 0;
    const Active = 1;
    const Archive = 2;
}

// Enquiry Status
class constEnquiryStatus
{
    const Lost = 0;
    const Lead = 1;
    const Member = 2;
}

//Follow Up Status
class constFollowUpStatus
{
    const Pending = 0;
    const Done = 1;
}

//Follow Up By
class constFollowUpBy
{
    const Call = 0;
    const SMS = 1;
    const Personal = 2;
}

// File PATHS
class constPaths
{
    const UserProfilePhoto = 'img/profile/';
    const UserProofPhoto = 'img/proof/';
    const StaffPhoto = 'img/staff/';
    const GymLogo = 'img/gym/';
    const UserDefaultImage = 'https://static.vecteezy.com/system/resources/thumbnails/009/734/564/small/default-avatar-profile-icon-of-social-media-user-vector.jpg';
}

class constFilePrefix
{
    const UserProfilePhoto = 'profile_';
    const UserProofPhoto = 'proof_';
    const StaffPhoto = 'staff_';
}

// Payment status
class constPaymentStatus
{
    const Unpaid = 0;
    const Paid = 1;
    const Partial = 2;
    const Overpaid = 3;
}

// Cheque status
class constChequeStatus
{
    const Recieved = 0;
    const Deposited = 1;
    const Cleared = 2;
    const Bounced = 3;
    const Reissued = 4;
}

// Invoice Items
class constInvoiceItem
{
    const admission = 'Admission';
    const gymSubscription = 'Gym Subscription';
    const taxes = 'Taxes';
}

//subscription
class constSubscription
{
    const Expired = 0;
    const onGoing = 1;
    const renewed = 2;
    const cancelled = 3;
}

//numbering mode
class constNumberingMode
{
    const Manual = 0;
    const Auto = 1;
}

//Payment mode
class constPaymentMode
{
    const Cheque = 0;
    const Cash = 1;
    const Transfer = 2;
    const Debit = 3;
    const Credit = 4;
}
