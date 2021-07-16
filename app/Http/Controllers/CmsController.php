<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cms;
use Exception;
use App\Leaders;
use App\Contact_us;

class CmsController extends Controller {

    public function index() {
        $cms = Cms::where('publish_status', '!=', '3')->get();
        $data['content'] = view('admin.cms.index', compact('cms'));
        return view('admin.layout', $data);
    }

    public function create() {
        $data['content'] = view('admin.cms.add');
        return view('admin.layout', $data);
    }

    public function edit($id) {
        $cms = Cms::find($id);
        $data['content'] = view('admin.cms.edit', compact('cms'));
        return view('admin.layout', $data);
    }

    public function save(Request $request) {

        $this->validate($request, [
            'page_title' => 'required',
            'page_url' => 'required',
            'status' => 'required',
            'page_content' => 'required',
        ]);
        try {
            $request->merge([
                'publish_status' => $request->status
            ]);
            
            $cms = Cms::create($request->all());

            if ($cms->id) {
                return redirect('manage/cms')->withSuccess('Cms Created Successfully!.');
            }

            return redirect()->back()
                            ->withInput()
                            ->withErrors('Please try after some time.');
        } catch (Exception $e) {
            return redirect()->back()
                            ->withInput()
                            ->withErrors('Please try after some time.');
        }
    }

    public function update(Request $request, $id) {
//echo 'fdffd';die;
        $url = Cms::where('page_url', '=', $request->page_url)->pluck('id');

        if (isset($url[0])) {
            if ($url[0] == $id) {
                $pattern = 'required';
            }
        } else {
            $pattern = 'required|unique:ce_cms,page_url';
        }

        $this->validate($request, [
            'page_title' => 'required',
            'page_url' => $pattern,
            'status' => 'required',
            'page_content' => 'required',
            'meta_keyword' => 'required',
            'meta_description' => 'required',
        ]);
        try {
            $cms = Cms::find($id);

            $cms->page_title = $request->page_title;
            $cms->page_url = $request->page_url;
            $cms->meta_title = '';

            $cms->meta_keyword = $request->meta_keyword;
            $cms->meta_description = $request->meta_description;
            $cms->page_content = $request->page_content;
            $cms->page_heading = $request->page_heading;
            $request->merge([
                'publish_status' => $request->status,
                'meta_title' => $request->page_title
            ]);
            if ($id != 1)
                $cms->publish_status = $request->status;

            if ($cms->save()) {
                return redirect('manage/cms/edit/' . $id)->withSuccess('CMS Updated Successfully!.');
            }

            return redirect()->back()
                            ->withInput()
                            ->withErrors('Please try after some time.');
        } catch (Exception $e) {
            return redirect()->back()
                            ->withInput()
                            ->withErrors('Please try after some time.');
        }
    }

    public function delete(Request $request, $id) {

        $user = Cms::find($id);
        $user->active_status = '2';
        try {
            if ($user->save()) {
                return redirect('manage/cms')->withSuccess('CMS Deleted Successfully!.');
            }

            return redirect()->back()
                            ->withInput()
                            ->withErrors('Please try after some time.');
        } catch (Exception $e) {
            return redirect()->back()
                            ->withInput()
                            ->withErrors('Please try after some time.');
        }
    }

    public function leaders() {
        $leaders = Leaders::where('status', '!=', '3')->get();
        $data['content'] = view('admin.cms.leaders', compact('leaders'));
        return view('admin.layout', $data);
    }

    public function deleteleader(Request $request, $id) {

        $leader = Leaders::find($id);
        $leader->status = '3';

        try {
            if ($leader->save()) {
                return redirect('manage/cms/leaders')->withSuccess('Leader Deleted Successfully!.');
            }
            return redirect()->back()
                            ->withInput()
                            ->withErrors('Please try after some time.');
        } catch (Exception $e) {
            return redirect()->back()
                            ->withInput()
                            ->withErrors('Please try after some time.');
        }
    }

    public function createleader() {
        $data['content'] = view('admin.cms.addleader');
        return view('admin.layout', $data);
    }

    public function saveleader(Request $request) {

        $this->validate($request, [
            'name' => 'required||max:190',
            'short_description' => 'required',
            'designation' => 'required||max:190',
            'profile_pic' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'status' => 'required',
        ]);

        $image = $request->file('profile_pic');
        $imagename = time() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('/uploads/leadership');
        $image->move($destinationPath, $imagename);

        $savedata = $request->all();
        $savedata['profile_pic'] = $imagename;


        $leader = Leaders::create($savedata);

        if ($leader->id) {
            return redirect('/manage/cms/leaders')->withSuccess('Leader details added Successfully!');
        }

        return redirect()->back()
                        ->withInput()
                        ->withErrors('Please try after some time.');
    }

    public function editleader($id) {

        $leader = Leaders::find($id);

        $data['content'] = view('admin.cms.editleader', compact('leader'));
        return view('admin.layout', $data);
    }

    public function updateleader(Request $request, $id) {

        $savedata = $request->except(['_token', 'profilepicStatus']);

        if ($request->profilepicStatus == 1) {

            $this->validate($request, [
                'profile_pic' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            ]);

            $image = $request->file('profile_pic');
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/leadership');
            $image->move($destinationPath, $imagename);
            $savedata['profile_pic'] = $imagename;
        }

        $this->validate($request, [
            'name' => 'required|max:190',
            'short_description' => 'required',
            'designation' => 'required|max:190',
            'status' => 'required',
        ]);

        Leaders::where('id', $id)->update($savedata);

        return redirect('/manage/cms/leaders')->withSuccess('Leader details updated successfully!');
    }

    public function aboutus() {

        $cmsObj = new Cms();

        $section1 = $cmsObj->getAboutusAmenities(1);
        $section2 = $cmsObj->getAboutusAmenities(2);
        $section3 = $cmsObj->getAboutusAmenities(3);
        $metadata = Cms::where('id', '=', '1')->where('publish_status', '!=', '3')->first();
        $data['content'] = view('admin.cms.about-us', compact('section1', 'section2', 'section3', 'metadata'));
        return view('admin.layout', $data);
    }

    public function editaboutus($id) {
        $cmsObj = new Cms();
        $sectionDetails = $cmsObj->getAboutusAmenities($id);
        $data['content'] = view('admin.cms.editaboutus', compact('sectionDetails'));
        return view('admin.layout', $data);
    }

    public function updateaboutus(Request $request, $id) {

        $savedata = [];
        if ($id == 1) {
            $this->validate($request, [
                'heading' => 'required',
                'short_description' => 'required'
            ]);

            $savedata['amenity_details'] = json_encode(['heading' => $request->heading, 'short_description' => $request->short_description]);
        } else if ($id == 2) {
            $this->validate($request, [
                'title' => 'required',
                'youtube_url' => 'required',
                'description' => 'required'
            ]);

            $savedata['amenity_details'] = json_encode(['title' => $request->title, 'youtube_url' => $request->youtube_url, 'description' => $request->description]);
        }if ($id == 3) {
            $this->validate($request, [
                'heading' => 'required',
                'description' => 'required'
            ]);

            $savedata['amenity_details'] = json_encode(['heading' => $request->heading, 'description' => $request->description]);
        }

        $cmsObj = new Cms();
        $sectionDetails = $cmsObj->updatevideoamenity($savedata, $id);

        return redirect('/manage/cms/about-us')->withSuccess('Page details updated successfully!');
    }

    public function save_about_meta(Request $request) {


        $this->validate($request, [
            'page_title' => 'required',
            'page_url' => 'required',
            'meta_keyword' => 'required',
            'meta_description' => 'required',
        ]);
        try {
            $cms = Cms::find(1);

            $cms->page_title = $request->page_title;
            $cms->page_url = $request->page_url;
            $cms->meta_title = $request->page_title;

            $cms->meta_keyword = $request->meta_keyword;
            $cms->meta_description = $request->meta_description;


            /* echo "<pre>";
              print_r($cms);
              echo "</pre>";
              exit; */

            if ($cms->save()) {
                return redirect('manage/cms/about-us')->withSuccess('CMS Updated Successfully!.');
            }

            return redirect()->back()
                            ->withInput()
                            ->withErrors('Please try after some time.');
        } catch (Exception $e) {
            return redirect()->back()
                            ->withInput()
                            ->withErrors('Please try after some time.');
        }
    }

    public function contactus() {
        $contact_us = Contact_us::select('*')->first();
        $metadata = Cms::where('id', '=', '8')->where('publish_status', '!=', '3')->first();
        $data['content'] = view('admin.cms.contact_us', compact('contact_us', 'metadata'));
        return view('admin.layout', $data);
    }

    public function contactusedit(Request $request) {

        $this->validate($request, [
            'page_title' => 'required',
            'address' => 'required',
            'address_line_2' => 'required',
            //'mobile' => 'required|min:10|max:10',
            //'landline_phone' => 'required',
            'page_url' => 'required',
            'meta_keyword' => 'required',
            'meta_description' => 'required',
                // 'email' => 'required|email'
        ]);
        $data = Contact_us::find(1);
        Cms::where('id', '=', '8')->update(['page_title' => $request->page_title, 'page_url' => $request->page_url, 'meta_keyword' => $request->meta_keyword, 'meta_description' => $request->meta_description]);

        // Contact_us::where('id','=','1')->update({'member_type' => $plan,'member_type' => $plan,'member_type' => $plan,'member_type' => $plan});
        $data->id = 1;
        $data->address = $request->address;
        $data->address_line_2 = $request->address_line_2;
        // $data->mobile = $request->mobile;
        // $data->landline_phone = $request->landline_phone;
        // $data->email = $request->email;


        if ($data->save()) {
            return redirect('manage/contact_us/edit')->withSuccess('Contact Us Updated Successfully!.');
        }
    }

}
