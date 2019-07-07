package com.plantsoilbplus.jbcom.plantsoilbplus;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.EditText;

public class RegisterPage extends AppCompatActivity {
    EditText UsernameEt2, PasswordEt2, ConfirmPasswordEt;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_register_page);

        UsernameEt2 = (EditText)findViewById(R.id.userRegis);
        PasswordEt2 = (EditText)findViewById(R.id.passRegis);
        ConfirmPasswordEt = (EditText)findViewById(R.id.passConfirmRegis);
    }

    public void OnRegis(View view) {
        String username = UsernameEt2.getText().toString();
        String password = PasswordEt2.getText().toString();
        String password_confirm = ConfirmPasswordEt.getText().toString();
        String type = "register";
        Log.e("RegisterTest Test",username + ", " + password+","+password_confirm);

        BackgroundWorker backgroundWorker = new BackgroundWorker(this);
        backgroundWorker.execute(type, username, password, password_confirm);
    }
}
