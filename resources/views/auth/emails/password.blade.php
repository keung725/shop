點擊此處重置您的密碼： {{ url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}
