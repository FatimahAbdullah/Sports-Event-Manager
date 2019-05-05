package com.example.mehreenathar.gladiator;

import android.app.DatePickerDialog;
import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.DatePicker;
import android.widget.EditText;
import android.widget.Spinner;
import android.widget.TextView;

import java.util.Calendar;
import java.util.List;

import ModelClasses.Club;

public class Add_Event_for_Club extends AppCompatActivity {

    private TextView eventDate;
    private Spinner clubSpinner;
    private Button registerEvent;
    private EditText eventNameET;
    private EditText eventDescriptionET;
    private EditText eventLocationET;
    private Club clubSelected;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_add__event_for__club);

        /*********************** References from XML ******************************/
        eventDate=(TextView) findViewById(R.id.eventDate);
        clubSpinner=(Spinner)findViewById(R.id.clubSpinner);
        registerEvent=(Button)findViewById(R.id.registerEvent);
        eventNameET=(EditText)findViewById(R.id.eventName);
        eventDescriptionET=(EditText)findViewById(R.id.eventDescription);
        eventLocationET=(EditText)findViewById(R.id.eventLocation);

        /******************* Date Picker SetUp  **********************************/
        eventDate.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Calendar calendar=Calendar.getInstance();//current date by default
                int year=calendar.get(Calendar.YEAR);
                int month=calendar.get(Calendar.MONTH);
                int day=calendar.get(Calendar.DAY_OF_MONTH);
                DatePickerDialog dialog=new DatePickerDialog(Add_Event_for_Club.this, new DatePickerDialog.OnDateSetListener() {
                    @Override
                    public void onDateSet(DatePicker view, int year, int month, int dayOfMonth) {
                        eventDate.setText(dayOfMonth+"/"+(month+1)+"/"+year);
                    }
                }, day,month, year);
                // dialog.getWindow().setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));
                dialog.show();
            }
        });

        /******************** Display list of Clubs in Spinner *************************/

        /********** Uncomment when model classes made  *****************************/

        /*
        List<Club> clubsToShow=sport.getClubs();//get club for all sports
        //to get data into spinner we use array adapter that by default works on strings
        ArrayAdapter<Club> adapter=new ArrayAdapter<Club>(this,android.R.layout.simple_spinner_item,coursesToShow);//tell how spinner should look (chose from default themes)
        adapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);//when drop down opened how spinner should look
        clubSpinner.setAdapter(adapter);

        //what t do when item in spinner is selected
        clubSpinner.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
            @Override
            public void onItemSelected(AdapterView<?> parent, View view, int position, long id) {
                clubSelected =(Club)parent.getSelectedItem();
            }

            @Override
            public void onNothingSelected(AdapterView<?> parent) {

            }
        });
        registerEvent.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                //change intent.....redirection
                Intent intent=new Intent(Add_Event_for_Club.this,Add_Event_for_Club.class);
                //add to share preference if needed
               // startActivityForResult(intent,1);
            }
        });
        */




    }
}
